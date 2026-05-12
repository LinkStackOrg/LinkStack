@php
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;

$usrhandl = Auth::user()->littlelink_name ?? null;

$sidebarSections = [
    [
        'title' => __('messages.Home'),
        'links' => [
            [
                'label' => __('messages.Dashboard'),
                'url' => route('panelIndex'),
                'active' => Request::segment(1) === 'dashboard',
                'icon' => 'bi bi-speedometer2',
            ],
            [
                'label' => __('messages.Add Link'),
                'url' => url('/studio/add-link'),
                'active' => Request::segment(2) === 'add-link',
                'icon' => 'bi bi-plus-square-fill',
            ],
        ],
    ],
    [
        'title' => __('messages.Personalization'),
        'links' => [
            [
                'label' => __('messages.Links'),
                'url' => url('/studio/links'),
                'active' => Request::segment(2) === 'links',
                'icon' => 'bi bi-grid-fill',
            ],
            [
                'label' => __('messages.Appearance'),
                'url' => url('/studio/page'),
                'active' => Request::segment(2) === 'page',
                'icon' => 'bi bi-pencil-square',
            ],
            [
                'label' => __('messages.Themes'),
                'url' => url('/studio/theme'),
                'active' => Request::segment(2) === 'theme',
                'icon' => 'bi bi-palette-fill',
            ],
        ],
    ],
];
@endphp

<!doctype html>
@include('layouts.lang')

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    <script src="{{ asset('assets/js/detect-dark-mode.js') }}"></script>

    <base href="{{ url()->current() }}" />

    @include('layouts.analytics')
    @stack('sidebar-stylesheets')
    @include('layouts.notifications')

    @php
        if (auth()->check()) {
            auth()->user()->touch();
        }
    @endphp

    @if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
        <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/dist/aos.css') }}">
    @include('layouts.fonts')
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.min.css?v=2.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css?v=2.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.min.css') }}">

    @if(file_exists(base_path("assets/dashboard-themes/dashboard.css")))
        <link rel="stylesheet" href="{{ asset('assets/dashboard-themes/dashboard.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/linkstack/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/external-dependencies/bootstrap-icons.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>

    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="{{ route('panelIndex') }}" class="navbar-brand">
                <div class="logo-main">
                    @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
                        <div class="logo-normal">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                        </div>
                        <div class="logo-mini">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                        </div>
                    @else
                        <div class="logo-normal">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30" height="30">
                        </div>
                        <div class="logo-mini">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30" height="30">
                        </div>
                    @endif
                </div>

                <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
            </a>

            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>

        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    @foreach($sidebarSections as $section)
                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">{{ $section['title'] }}</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>

                        @foreach($section['links'] as $link)
                            <li class="nav-item">
                                <a class="nav-link {{ $link['active'] ? 'active' : '' }}" href="{{ $link['url'] }}">
                                    <i class="{{ $link['icon'] }} icon-20"></i>
                                    <span class="item-name">{{ $link['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="sidebar-footer"></div>
    </aside>

    <main class="main-content">
        <div class="position-relative iq-banner">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="{{ route('panelIndex') }}" class="navbar-brand">
                        <div class="logo-main">
                            @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
                                <div class="logo-normal">
                                    <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                                </div>
                                <div class="logo-mini">
                                    <img class="img logo" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" style="width:auto;height:30px;">
                                </div>
                            @else
                                <div class="logo-normal">
                                    <img class="img logo" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30" height="30">
                                </div>
                                <div class="logo-mini">
                                    <img class="img logo" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30" height="30">
                                </div>
                            @endif
                        </div>

                        <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
                    </a>

                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon">
                            <span class="mt-2 navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                            <li class="me-0 me-xl-2">
                                <div class="dropdown d-flex flex-row align-items-center">
                                    <a target="_blank" href="{{ url('/@'.Auth::user()->littlelink_name) }}">
                                        <button style="border-bottom-right-radius:0;border-top-right-radius:0;" type="button" class="btn btn-primary btn-sm pe-2">
                                            {{ __('messages.View Page') }}
                                        </button>
                                    </a>

                                    <button style="border-bottom-left-radius:0;border-top-left-radius:0;" class="btn btn-primary btn-sm dropdown-toggle ms-auto px-1" type="button" id="dropdownMenuButtonSM" data-bs-toggle="dropdown">
                                        <i class="btn-seg-ico bi bi-share-fill"></i>
                                    </button>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSM">
                                        <li><h6 class="dropdown-header">{{ __('messages.Share your profile:') }}</h6></li>

                                        @if(env('SUPPORTED_DOMAINS') !== '' && env('SUPPORTED_DOMAINS') !== null)
                                            @php
                                                $sDomains = str_replace(' ', '', env('SUPPORTED_DOMAINS'));
                                                $sDomains = explode(',', $sDomains);
                                            @endphp

                                            @foreach($sDomains as $domain)
                                                <li>
                                                    <a class="dropdown-item share-button" style="cursor:pointer!important;" data-share="{{ 'https://'.$domain.'/@'.Auth::user()->littlelink_name }}">
                                                        <i class="bi bi-files"></i> {{ $domain }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <a class="dropdown-item share-button" style="cursor:pointer!important;" data-share="{{ url('').'/@'.Auth::user()->littlelink_name }}">
                                                    <i class="bi bi-files"></i> {{ str_replace(['http://', 'https://'], '', url('')) }}
                                                </a>
                                            </li>
                                        @endif

                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal" style="cursor:pointer!important;" data-bs-target="#staticBackdrop">
                                                <i class="bi bi-qr-code-scan"></i> {{ __('messages.QR Code') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                                    <i class="bi bi-bell-fill icon-24"></i>
                                    @if($GLOBALS['activenotify'])
                                        <span class="bg-danger dots"></span>
                                    @endif
                                </a>

                                <div class="p-0 sub-drop dropdown-menu dropdown-menu-end" aria-labelledby="notification-drop">
                                    <div class="m-0 shadow-none card">
                                        <div class="py-3 card-header d-flex justify-content-between bg-primary">
                                            <div class="header-title">
                                                <h5 class="mb-0 text-white">{{ __('messages.All Notifications') }}</h5>
                                            </div>
                                        </div>

                                        <div class="p-0 card-body">
                                            @stack('notifications')
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="#" class="py-0 nav-link d-flex align-items-center dropdown-toggle" id="navbarDropdown" data-bs-toggle="dropdown">
                                    @if(file_exists(base_path(findAvatar(Auth::user()->id))))
                                        <img src="{{ url(findAvatar(Auth::user()->id)) }}" alt="User-Profile" class="img-fluid avatar avatar-40 avatar-rounded" style="object-fit:cover;">
                                    @elseif(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
                                        <img src="{{ url("assets/linkstack/images/")."/".findFile('avatar') }}" alt="User-Profile" class="img logo" style="width:auto;height:30px;">
                                    @else
                                        <img src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="User-Profile" class="img-fluid avatar avatar-40 avatar-rounded">
                                    @endif

                                    <div class="caption ms-3 d-none d-md-block">
                                        <h6 class="mb-0 caption-title">{{ Auth::user()->name }}</h6>
                                        <p class="mb-0 caption-sub-title">
                                            @if(Auth::user()->role === 'admin')
                                                {{ __('messages.Administrator') }}
                                            @elseif(Auth::user()->role === 'vip')
                                                {{ __('messages.Verified user') }}
                                            @else
                                                {{ __('messages.User') }}
                                            @endif
                                        </p>
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/studio/page') }}">
                                            <i class="bi bi-person-fill"></i> {{ __('messages.Profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ url('/studio/profile') }}">
                                            <i class="bi bi-gear-fill"></i> {{ __('messages.Settings') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button">
                                            <i class="bi bi-brush-fill"></i> {{ __('messages.Styling') }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-in-left"></i> {{ __('messages.Logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <style>
                .header-block {
                    background-color: var(--bs-primary);
                    border-bottom-left-radius: 1rem;
                    border-bottom-right-radius: 1rem;
                }
            </style>

            <div class="iq-navbar-header header-block mb-2" style="height:205px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="z-index:5;position:relative;" class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    @if(!isset($usrhandl))
                                        <h1>👋 {{ __('messages.Hi') }}, {{ __('messages.stranger') }}</h1>
                                    @else
                                        <h1>👋 {{ __('messages.Hi') }}, {{ '@'.$usrhandl }}</h1>
                                    @endif

                                    <h5>{{ __('messages.welcome', ['appName' => config('app.name')]) }}</h5>
                                </div>

                                <div>
                                    @if(!isset($usrhandl))
                                        <a href="{{ url('/studio/page') }}" class="btn btn-link btn-soft-light">
                                            <i style="top:3px;position:relative;font-size:2.5vh;" class="bi bi-at"></i>
                                            {{ __('messages.Set a handle') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="z-index:0!important;" class="iq-header-img">
                    @php
                        $headerImage = file_exists(base_path("assets/dashboard-themes/header.png"))
                            ? asset('assets/dashboard-themes/header.png')
                            : asset('assets/images/dashboard/top-header-overlay.png');
                    @endphp

                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div>
        </div>

        @yield('content')

        <footer class="footer">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    @if(env('DISPLAY_FOOTER') === true)
                        @if(env('DISPLAY_FOOTER_HOME') === true)
                            <li class="list-inline-item">
                                <a class="list-inline-item" href="{{ url('') }}">{{ footer('Home') }}</a>
                            </li>
                        @endif

                        @if(env('DISPLAY_FOOTER_TERMS') === true)
                            <li class="list-inline-item">
                                <a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Terms')) }}">{{ footer('Terms') }}</a>
                            </li>
                        @endif

                        @if(env('DISPLAY_FOOTER_PRIVACY') === true)
                            <li class="list-inline-item">
                                <a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Privacy')) }}">{{ footer('Privacy') }}</a>
                            </li>
                        @endif

                        @if(env('DISPLAY_FOOTER_CONTACT') === true)
                            <li class="list-inline-item">
                                <a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Contact')) }}">{{ footer('Contact') }}</a>
                            </li>
                        @endif
                    @endif
                </ul>

                <div class="right-panel">
                    {{ __('messages.Copyright') }} &copy; @php echo date('Y'); @endphp {{ config('app.name') }}

                    @if(env('DISPLAY_CREDIT_FOOTER') === true)
                        <span>
                            - {{ __('messages.Made with') }}
                            <i class="bi bi-heart-fill"></i>
                        </span>
                        {{ __('messages.by') }}
                        <a href="https://linkstack.org/" target="_blank">LinkStack</a>.
                    @endif
                </div>
            </div>
        </footer>
    </main>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" data-bs-scroll="true" data-bs-backdrop="true">
        <div class="offcanvas-header">
            <div class="d-flex align-items-center">
                <h3 class="offcanvas-title me-3">{{ __('messages.Settings') }}</h3>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>

        <div class="offcanvas-body data-scrollbar">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mb-3">{{ __('messages.Scheme') }}</h5>

                    <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div class="btn btn-border" data-setting="color-mode" data-name="color" data-value="auto">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <span class="ms-2">{{ __('messages.Auto') }}</span>
                        </div>

                        <div class="btn btn-border" data-setting="color-mode" data-name="color" data-value="dark">
                            <i class="bi bi-moon-fill"></i>
                            <span class="ms-2">{{ __('messages.Dark') }}</span>
                        </div>

                        <div class="btn btn-border active" data-setting="color-mode" data-name="color" data-value="light">
                            <i class="bi bi-sun-fill"></i>
                            <span class="ms-2">{{ __('messages.Light') }}</span>
                        </div>
                    </div>

                    <hr class="hr-horizontal">

                    <h5 class="mt-4 mb-3">{{ __('messages.Color Customizer') }}</h5>

                    <div class="grid-cols-5 mb-4 d-grid gap-x-2">
                        <div class="btn btn-border bg-transparent" data-value="theme-color-blue" data-info="#573BFF" data-setting="color-mode1" data-name="color"></div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-gray" data-info="#FD8D00" data-setting="color-mode1" data-name="color"></div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-red" data-info="#366AF0" data-setting="color-mode1" data-name="color"></div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-yellow" data-info="#6410F1" data-setting="color-mode1" data-name="color"></div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-pink" data-info="#25C799" data-setting="color-mode1" data-name="color"></div>
                    </div>

                    <hr class="hr-horizontal">

                    <h5 class="mt-4 mb-3">{{ __('messages.Sidebar Color') }}</h5>

                    <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color" data-value="sidebar-white">
                            {{ __('messages.Default') }}
                        </div>
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color" data-value="sidebar-dark">
                            {{ __('messages.Dark') }}
                        </div>
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color" data-value="sidebar-color">
                            {{ __('messages.Color') }}
                        </div>
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color" data-value="sidebar-transparent">
                            {{ __('messages.Transparent') }}
                        </div>
                    </div>

                    <hr class="hr-horizontal">

                    <h5 class="mt-4 mb-3">{{ __('messages.Sidebar Types') }}</h5>

                    <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/light/03.png') }}" alt="mini" class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-mini">
                            <span class="mt-2">{{ __('messages.Mini') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/light/04.png') }}" alt="hover" class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-hover" data-extra-value="sidebar-mini">
                            <span class="mt-2">{{ __('messages.Hover') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/light/05.png') }}" alt="boxed" class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-boxed">
                            <span class="mt-2">{{ __('messages.Boxed') }}</span>
                        </div>
                    </div>

                    <hr class="hr-horizontal">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('messages.Scan QR Code') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                @php
                    try {
                        $redirectURL = url('').'/u/'.Auth::user()->id;

                        $argValues = config('advanced-config.qr_code_gradient') ?? [0, 0, 0, 0, 0, 0, 'diagonal'];
                        list($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7) = $argValues;

                        if (extension_loaded('imagick')) {
                            $imgSrc = QrCode::format('png')
                                ->gradient($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7)
                                ->eye('circle')
                                ->style('round')
                                ->size(1000)
                                ->generate($redirectURL);

                            $imgSrc = 'data:image/png;base64,' . base64_encode($imgSrc);
                            $imgType = 'png';
                        } else {
                            $imgSrc = QrCode::gradient($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7)
                                ->eye('circle')
                                ->style('round')
                                ->size(1000)
                                ->generate($redirectURL);

                            $imgSrc = 'data:image/svg+xml;base64,' . base64_encode($imgSrc);
                            $imgType = 'svg';
                        }
                    } catch(Exception $e) {
                        $imgSrc = url('/assets/linkstack/images/themes/no-preview.png');
                        $imgType = null;
                    }
                @endphp

                <div class="modal-body">
                    <div class="bd-example">
                        <img id="generatedImage" draggable="false" src="{{ $imgSrc ?? '' }}" style="width:100%;height:auto;" class="bd-placeholder-img img-thumbnail">
                    </div>
                </div>

                <div class="modal-footer">
                    @if($imgType === 'png')
                        <button type="button" class="btn btn-info" id="downloadButton">{{ __('messages.Download') }}</button>
                    @endif

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>
    <script src="{{ asset('assets/js/charts/widgetcharts.js') }}"></script>
    <script src="{{ asset('assets/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('assets/js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/fslightbox.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/setting.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slider-tabs.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/form-wizard.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/dist/aos.js') }}"></script>
    <script src="{{ asset('assets/js/hope-ui.js') }}" defer></script>
    <script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/prism.mini.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-block-ui.js') }}"></script>
    <script src="{{ asset('assets/js/main-dashboard.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const downloadButton = document.getElementById("downloadButton");
            const generatedImage = document.getElementById("generatedImage");

            if (downloadButton && generatedImage) {
                downloadButton.addEventListener("click", function () {
                    const format = generatedImage.getAttribute("data-format") || "png";
                    const downloadLink = document.createElement("a");

                    downloadLink.href = generatedImage.src;
                    downloadLink.download = "generated_image." + format;

                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                });
            }

            document.querySelectorAll(".share-button").forEach(button => {
                button.addEventListener("click", () => {
                    const valueToShare = button.dataset.share;

                    if (navigator.share) {
                        navigator.share({
                            title: "{{ __('messages.Share your profile') }}",
                            text: valueToShare,
                            url: valueToShare,
                        }).catch(err => console.error("{{ __('messages.Error sharing:') }}", err));
                    } else {
                        navigator.clipboard.writeText(valueToShare)
                            .then(() => alert("{{ __('messages.Text copied to clipboard!') }}"))
                            .catch(err => alert("{{ __('messages.Error copying text:') }}", err));
                    }
                });
            });
        });
    </script>

    @stack('sidebar-scripts')
</body>
</html>