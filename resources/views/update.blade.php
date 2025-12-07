@extends('layouts.updater')

@push('updater-body')

    @php
        // Must end with '/'
        $betaServer          = env('BETA_SERVER', 'https://beta.linkstack.org/');
        $betaPreUpdateServer = env('BETA_PRE_UPDATE_SERVER', 'https://pre-update.linkstack.org/beta/');
        $updateServer        = env('UPDATE_SERVER', 'https://update.linkstack.org/');
        $versionServer       = env('VERSION_SERVER', 'https://version.linkstack.org/');
        $preUpdateServer     = env('PRE_UPDATE_SERVER', 'https://pre-update.linkstack.org/');
        $repositoryUrl       = env('REPOSITORY_URL', 'https://github.com/linkstackorg/linkstack/');

        $isBeta = env('JOIN_BETA', false);

        if ($isBeta) {
            $preUpdateServer = $betaPreUpdateServer;
        }

        try {
            $Vbeta = trim(Http::timeout(5)->get($betaServer . 'vbeta.json')->body());
            $Vbeta_git = trim(Http::timeout(5)->get($betaServer . 'version.json')->body());
            $Vgit = trim(Http::timeout(5)->get($versionServer)->body());
            $Vlocal = trim(file_get_contents(base_path('version.json')));
        } catch (Exception $e) {
            session(['update_error' => 'Unexpected error. ' . $e->getMessage()]);
        }
    @endphp

    <div class="container">
        @if ((auth()->check() && auth()->user()->role == 'admin' && $Vgit > $Vlocal) || $isBeta)
            @if (empty($_SERVER['QUERY_STRING']))
                @php
                    // Store authenticated admin user ID in cache for session persistence during update
                    // Cache is PHP-internal and more secure than file storage
                    if (auth()->check() && auth()->user()->role === 'admin') {
                        try {
                            // Store for 2 hours (7200 seconds)
                            Cache::put('update_auth_user_id', auth()->user()->id, 7200);
                        } catch (Exception $e) {
                            // If storing fails, continue anyway - worst case user might need to re-login
                        }
                    }
                @endphp
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
                </div>
                <h1>{{ __('messages.Updater') }}</h1>
                @if ($isBeta)
                    <p>{{ __('messages.Latest beta version') }} =
                        {{ $Vbeta }}</p>
                    <p>{{ __('messages.Installed beta version') }} =
                        {{ file_exists(base_path('vbeta.json')) ? file_get_contents(base_path('vbeta.json')) : __('messages.none') }}
                    </p>
                    <p>{{ $Vgit > $Vlocal ? __('messages.You need to update to the latest mainline release') : __('messages.You’re running the latest mainline release') }}
                    </p>
                @else
                    <a target="_blank" href="{{ $repositoryUrl }}releases">
                        <code style="color:#222;transform:scale(.9);">{{ $Vlocal }} -> {{ $Vgit }}</code>
                    </a>
                    <h4>{{ __('messages.update.manually') }}</h4>
                @endif
                <br>
                <div class="row">
                    <a class="btn"
                        href="{{ url()->current() }}/?{{ env('SKIP_UPDATE_BACKUP') == true ? 'preparing' : 'backup' }}">
                        <button><i class="fa-solid fa-user-gear btn"></i>
                            {{ __('messages.Update automatically') }}</button>
                    </a>
                    <a class="btn" href="https://linkstack.org/update" target="_blank">
                        <button><i class="fa-solid fa-download btn"></i> {{ __('messages.Update manually') }}</button>
                    </a>
                </div>
            @endif

            @if ($_SERVER['QUERY_STRING'] === 'updating')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Updating') }}</h1>
                @php
                    set_time_limit(0);
                    try {
                        // Determine the latest version and file URL
                        $latestVersion = $isBeta ? $Vbeta_git : $Vgit;
                        $fileUrl = $isBeta ? $betaServer . $latestVersion . '.zip' : $updateServer . $latestVersion . '.zip';

                        // Download the update file
                        $response = Http::timeout(120)->get($fileUrl);

                        if ($response->failed()) {
                            throw new Exception("HTTP request failed: {$response->status()} - {$response->body()}");
                        }

                        // Save the downloaded ZIP file to storage
                        $zipPath = storage_path('update.zip');
                        $result = file_put_contents($zipPath, $response->body());
                        if ($result === false) {
                            throw new Exception('Failed to write update.zip to storage.');
                        }

                        // Initialize the ZIP archive
                        $zip = new ZipArchive();
                        if ($zip->open($zipPath) !== true) {
                            throw new Exception('Failed to open ZIP archive for extraction.');
                        }

                        // Extract the contents to the base path
                        $extractPath = base_path();
                        if (!$zip->extractTo($extractPath)) {
                            throw new Exception('ZIP extraction failed.');
                        }

                        $zip->close();

                        // Delete the ZIP file after extraction
                        if (!unlink($zipPath)) {
                            Log::warning("Failed to delete ZIP file: $zipPath");
                        }
                    } catch (Exception $e) {
                        session(['update_error' => 'Fatal error. ' . $e->getMessage()]);
                    }
                @endphp

                @if (session()->has('update_error'))
                    <meta http-equiv="refresh" content="1; {{ url()->current() }}/?error" />
                @else
                    <meta http-equiv="refresh" content="0; {{ url()->current() }}/?finishing" />
                @endif

            @endif

            @if ($_SERVER['QUERY_STRING'] === 'backup')
                @push('updater-head')
                    <meta http-equiv="refresh" content="2; URL={{ url()->current() }}/?backups" />
                @endpush
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Creating backup') }}</h1>
            @endif

            @if ($_SERVER['QUERY_STRING'] === 'backups')
                @php
                    set_time_limit(0);
                    // Test if the Artisan command is available
                    try {
                        $exitCode = Artisan::call('list');

                        if ($exitCode !== 0) {
                            session(['update_error' => "Backup creation failed. Your system doesn't support backups. Consider disabling update backups in your config. Exit code: $exitCode"]);
                        }
                    } catch (Exception $e) {
                        session(['update_error' => "Backup creation failed. This may indicate that your system doesn't support backups or that the process exceeded the time limit. Consider disabling update backups in your config. Exit code: " . $e->getMessage()]);
                    }

                    try {
                        Artisan::call('backup:clean', ['--disable-notifications' => true]);
                    } catch (Exception $e) {
                        session(['update_error' => $e->getMessage()]);
                    }

                    try {
                        Artisan::call('backup:run', ['--only-files' => true, '--disable-notifications' => true]);
                    } catch (Exception $e) {
                        session(['update_error' => $e->getMessage()]);
                    }
                @endphp

                @if (session()->has('update_error'))
                    <meta http-equiv="refresh" content="1; {{ url()->current() }}/?error" />
                @else
                    @php file_put_contents(base_path('backups/CANUPDATE'), ''); @endphp
                    <meta http-equiv="refresh" content="1; {{ url()->current() }}?preparing" />
                @endif
            @endif

            @if ($_SERVER['QUERY_STRING'] === 'preparing')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Preparing update') }}</h1>
                @php
                    set_time_limit(0);

                    if (file_exists(base_path() . '/storage/update.zip')) {
                        try {
                            unlink(base_path() . '/storage/update.zip');
                        } catch (Exception $e) {
                            session(['update_error' => 'File permission error. ' . $e->getMessage()]);
                        }
                    }

                    try {
                        $file = Http::timeout(10)->get($preUpdateServer)->body();
                        $filePath = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'pre-update.blade.php');
                        file_put_contents($filePath, $file);
                    } catch (Exception $e) {
                        session(['update_error' => 'Could not prepare update. ' . $e->getMessage()]);
                    }
                @endphp
                @if (session()->has('update_error'))
                    <meta http-equiv="refresh" content="1; {{ url()->current() }}/?error" />
                @else
                    @include('components.pre-update')
                    <meta http-equiv="refresh" content="1; {{ url()->current() }}?updating" />
                @endif
            @endif

        @elseif(empty($_SERVER['QUERY_STRING']))
            <div class="logo-container fadein">
                <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
            </div>
            <h1>{{ __('messages.No new version') }}</h1>
            <h4>{{ __('messages.There is no new version available') }}</h4>
            <br>
            <div class="row">
                <a class="btn" href="{{ url('dashboard') }}">
                    <button><i class="fa-solid fa-house-laptop btn"></i> {{ __('messages.Admin Panel') }}</button>
                </a>
            </div>
        @endif

        @if ($_SERVER['QUERY_STRING'] === 'finishing')
            @php
                set_time_limit(0);
                $debug = null;
                if (EnvEditor::getKey('APP_DEBUG') == 'false') {
                    if (EnvEditor::keyExists('APP_DEBUG')) {
                        EnvEditor::editKey('APP_DEBUG', 'true');
                    }
                    if (EnvEditor::keyExists('APP_ENV')) {
                        EnvEditor::editKey('APP_ENV', 'local');
                    }
                    if (EnvEditor::keyExists('LOG_LEVEL')) {
                        EnvEditor::editKey('LOG_LEVEL', 'debug');
                    }
                    $debug = true;
                }
            @endphp
            <div class="logo-container fadein">
                <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
            </div>
            <h1 class="loadingtxt">{{ __('messages.Finishing up') }}</h1>
            @include('components.finishing')
            @php
                EnvEditor::editKey('MAINTENANCE_MODE', false);
                if ($debug === true) {
                    if (EnvEditor::keyExists('APP_DEBUG')) {
                        EnvEditor::editKey('APP_DEBUG', 'false');
                    }
                    if (EnvEditor::keyExists('APP_ENV')) {
                        EnvEditor::editKey('APP_ENV', 'production');
                    }
                    if (EnvEditor::keyExists('LOG_LEVEL')) {
                        EnvEditor::editKey('LOG_LEVEL', 'error');
                    }
                }
            @endphp
            @if(!session()->has('update_error') && ($isBeta || $Vgit === $Vlocal))
                <meta http-equiv="refresh" content="0; {{ url()->current() }}?success" />
            @else
                @php
                if (!session()->has('update_error')) {
                    session(['update_error' => 'Update failed unexpectedly. Please try again later.']);
                }
                @endphp
                <meta http-equiv="refresh" content="0; {{ url()->current() }}?error" />
            @endif
        @endif

        @if ($_SERVER['QUERY_STRING'] === 'success')
            @php
                // Clean up cache after successful update
                try {
                    Cache::forget('update_auth_user_id');
                } catch (Exception $e) {
                    // Ignore cleanup errors
                }
            @endphp
            <div class="logo-container fadein">
                <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
            </div>
            <h1>{{ __('messages.Success!') }}</h1>
            @if ($isBeta)
                <p>{{ __('messages.Latest beta version') }} =
                    {{ $Vbeta }}</p>
                <p>{{ __('messages.Installed beta version') }} =
                    {{ file_exists(base_path('vbeta.json')) ? file_get_contents(base_path('vbeta.json')) : __('messages.none') }}
                </p>
                <p>{{ $Vgit > $Vlocal ? __('messages.You need to update to the latest mainline release') : __('messages.You’re running the latest mainline release') }}
                </p>
            @else
                <h4>{{ __('messages.The update was successful') }}</h4>
                <a class="noteslink" href="{{ $repositoryUrl }}releases/latest" target="_blank">
                    <i class="fa-solid fa-up-right-from-square"></i> {{ __('messages.View the release notes') }}
                </a>
                <br>
            @endif
            <br>
            <div class="row">
                <a class="btn" href="{{ url('dashboard') }}">
                    <button><i class="fa-solid fa-house-laptop btn"></i> {{ __('messages.Admin Panel') }}</button>
                </a>
                @if ($isBeta)
                    <a class="btn" href="{{ url()->current() }}/">
                        <button><i class="fa-solid fa-arrow-rotate-right btn"></i> {{ __('messages.Run again') }}</button>
                    </a>
                @endif
            </div>
        @endif

        @if ($_SERVER['QUERY_STRING'] === 'error')
            @php
                EnvEditor::editKey('MAINTENANCE_MODE', false);
                
                // Clean up cache on error
                try {
                    Cache::forget('update_auth_user_id');
                } catch (Exception $e) {
                    // Ignore cleanup errors
                }
            @endphp

            <div class="logo-container fadein">
                <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
            </div>
            <h1>{{ __('messages.Error') }}</h1>
            <h4>{{ __('messages.Something went wrong with the update') }} :(</h4>

            @if (session()->has('update_error'))
                <div class="alert-box alert-box-error">
                    <strong>Error:</strong>
                    {{ session('update_error') }}
                </div>
                @php
                    session()->forget('update_error');
                @endphp
            @else
                <div class="alert-box alert-box-error">
                    <strong>Error:</strong>
                    Unknown error
                </div>
            @endif

            <br>
            <div class="row">
                &ensp;<a class="btn" href="{{ url('dashboard') }}"><button><i class="fa-solid fa-house-laptop btn"></i>
                        {{ __('messages.Admin Panel') }}</button></a>&ensp;
            </div>
        @endif

    </div>
@endpush