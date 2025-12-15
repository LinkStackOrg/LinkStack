<?php use Illuminate\Support\Facades\Auth; ?>
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
            $Vbeta = trim(
                Http::timeout(5)
                    ->get($betaServer . 'vbeta.json')
                    ->body(),
            );
            $Vbeta_git = trim(
                Http::timeout(5)
                    ->get($betaServer . 'version.json')
                    ->body(),
            );
            $Vgit = trim(Http::timeout(5)->get($versionServer)->body());
            $Vlocal = trim(file_get_contents(base_path('version.json')));
        } catch (Exception $e) {
            session(['update_error' => 'Unexpected error. ' . $e->getMessage()]);
        }

        // Store the user ID to restore session after update
        $preUpdateUserId = auth()->id();
        if ($preUpdateUserId) {
            session(['updater_user_id' => $preUpdateUserId]);
        }
    @endphp

    <div class="container">

        <script>
            async function safeRedirect(nextUrl) {
                try {
                    const res = await fetch('{{ url('/session-check') }}', {
                        method: 'GET',
                        credentials: 'same-origin',
                        cache: 'no-store',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    if (res.ok) {
                        window.location.replace(nextUrl);
                    } else {
                        console.warn("Session invalid, redirecting to login");
                        window.location.replace('{{ url('login') }}');
                    }
                } catch (e) {
                    console.error("Session validation failed", e);
                    window.location.reload();
                }
            }
        </script>

        @if ((auth()->user()->role == 'admin' && $Vgit > $Vlocal) || $isBeta)

            {{-- Initial update screen --}}
            @if (empty($_SERVER['QUERY_STRING']))
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo">
                </div>
                <h1>{{ __('messages.Updater') }}</h1>

                @if ($isBeta)
                    <p>{{ __('messages.Latest beta version') }} = {{ $Vbeta }}</p>
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
                        href="javascript:safeRedirect('{{ url()->current() }}/?{{ env('SKIP_UPDATE_BACKUP') ? 'preparing' : 'backup' }}');">
                        <button><i class="fa-solid fa-user-gear btn"></i>
                            {{ __('messages.Update automatically') }}</button>
                    </a>
                    <a class="btn" href="https://linkstack.org/update" target="_blank">
                        <button><i class="fa-solid fa-download btn"></i> {{ __('messages.Update manually') }}</button>
                    </a>
                </div>
            @endif

            {{-- Backup --}}
            @if ($_SERVER['QUERY_STRING'] === 'backup')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Creating backup') }}</h1>
                @php
                    set_time_limit(0);
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
                    <script>
                        safeRedirect('{{ url()->current() }}/?error');
                    </script>
                @else
                    @php file_put_contents(base_path('backups/CANUPDATE'), ''); @endphp
                    <script>
                        safeRedirect('{{ url()->current() }}?preparing');
                    </script>
                @endif
            @endif

            {{-- Preparing --}}
            @if ($_SERVER['QUERY_STRING'] === 'preparing')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Preparing update') }}</h1>
                @php
                    set_time_limit(0);
                    if (file_exists(storage_path('update.zip'))) {
                        unlink(storage_path('update.zip'));
                    }
                    try {
                        $file = Http::timeout(10)->get($preUpdateServer)->body();
                        file_put_contents(base_path('resources/views/components/pre-update.blade.php'), $file);
                    } catch (Exception $e) {
                        session(['update_error' => 'Could not prepare update. ' . $e->getMessage()]);
                    }
                @endphp

                @if (session()->has('update_error'))
                    <script>
                        safeRedirect('{{ url()->current() }}/?error');
                    </script>
                @else
                    @include('components.pre-update')
                    <script>
                        safeRedirect('{{ url()->current() }}?updating');
                    </script>
                @endif
            @endif

            {{-- Updating --}}
            @if ($_SERVER['QUERY_STRING'] === 'updating')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Updating') }}</h1>
                @php
                    set_time_limit(0);
                    try {
                        $latestVersion = $isBeta ? $Vbeta_git : $Vgit;
                        $fileUrl = $isBeta
                            ? $betaServer . $latestVersion . '.zip'
                            : $updateServer . $latestVersion . '.zip';
                        $response = Http::timeout(120)->get($fileUrl);
                        if ($response->failed()) {
                            throw new Exception("HTTP request failed: {$response->status()}");
                        }

                        $zipPath = storage_path('update.zip');
                        file_put_contents($zipPath, $response->body());

                        $zip = new ZipArchive();
                        if ($zip->open($zipPath) !== true) {
                            throw new Exception('Failed to open ZIP archive');
                        }
                        $zip->extractTo(base_path());
                        $zip->close();
                        unlink($zipPath);

                        $restoreId = session('updater_user_id') ?? ($preUpdateUserId ?? null);
                        if ($restoreId) {
                            Auth::loginUsingId($restoreId, true);
                            session()->regenerate();
                        }
                    } catch (Exception $e) {
                        session(['update_error' => 'Fatal error. ' . $e->getMessage()]);
                    }
                @endphp

                @if (session()->has('update_error'))
                    <script>
                        safeRedirect('{{ url()->current() }}/?error');
                    </script>
                @else
                    <script>
                        safeRedirect('{{ url()->current() }}?finishing');
                    </script>
                @endif
            @endif

            {{-- Finishing --}}
            @if ($_SERVER['QUERY_STRING'] === 'finishing')
                <div class="logo-container fadein">
                    <img class="logo-img" src="{{ asset('assets/linkstack/images/logo-loading.svg') }}" alt="Logo">
                </div>
                <h1 class="loadingtxt">{{ __('messages.Finishing up') }}</h1>
                @php
                    set_time_limit(0);
                    $debug = null;
                    if (!Auth::check() && session('updater_user_id')) {
                        Auth::loginUsingId(session('updater_user_id'), true);
                        session()->regenerate();
                    }
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
                    EnvEditor::editKey('MAINTENANCE_MODE', false);
                    if ($debug) {
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
                @include('components.finishing')
                @if (!session()->has('update_error') && ($isBeta || $Vgit === $Vlocal))
                    <script>
                        safeRedirect('{{ url()->current() }}?success');
                    </script>
                @else
                    <script>
                        safeRedirect('{{ url()->current() }}?error');
                    </script>
                @endif
            @endif

        @endif {{-- end admin update check --}}

    </div>
@endpush