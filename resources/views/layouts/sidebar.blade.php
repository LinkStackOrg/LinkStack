@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
    use App\Models\User;
    use App\Models\UserData;

    $usrhandl = Auth::user()->littlelink_name;

    $spa = env('SPA_MODE', false);

    $betaServer    = env('BETA_SERVER', 'https://beta.linkstack.org/');
    $versionServer = env('VERSION_SERVER', 'https://version.linkstack.org/');
@endphp
<!doctype html>
@include('layouts.lang')
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }}</title>

    @php include app_path("View/Includes/DarkMode.php"); @endphp

    @if($spa)
        @livewireStyles
    @endif

    <base href="{{ url()->current() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    @include('layouts.analytics')
    @stack('sidebar-stylesheets')

    @php
        // Update the 'updated_at' timestamp for the currently authenticated user
        if (auth()->check()) {
            $user = auth()->user();
            $user->touch();
        }
    @endphp

    <!-- Favicon -->
    @if (file_exists(base_path('assets/linkstack/images/') . findFile('favicon')))
        <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/' . findFile('favicon')) }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}" />

    <!-- Aos Animation Css -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/aos/dist/aos.css') }}" /> --}}

    @include('layouts.fonts')

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.min.css?v=2.0.0') }}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css?v=2.0.0') }}" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark.min.css') }}" />

    <!-- Customizer Css -->
    @if (file_exists(base_path('assets/dashboard-themes/dashboard.css')))
        <link rel="stylesheet" href="{{ asset('assets/dashboard-themes/dashboard.css') }}" />
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css') }}" />
    @endif

    <!-- RTL Css -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css') }}" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/linkstack/css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/external-dependencies/bootstrap-icons.css') }}">

    <!-- Library Bundle Script -->
    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>

    <!-- External Library Bundle Script -->
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>

    <!-- Widgetchart Script -->
    {{-- <script src="{{ asset('assets/js/charts/widgetcharts.js') }}"></script> --}}

    <!-- fslightbox Script -->
    {{-- <script src="{{ asset('assets/js/plugins/fslightbox.js') }}"></script> --}}

    <!-- Slider-tab Script -->
    {{-- <script src="{{ asset('assets/js/plugins/slider-tabs.js') }}"></script> --}}

    <!-- Form Wizard Script -->
    {{-- <script src="{{ asset('assets/js/plugins/form-wizard.js') }}"></script> --}}

    <!-- AOS Animation Plugin-->
    {{-- <script src="{{ asset('assets/vendor/aos/dist/aos.js') }}"></script> --}}

    <!-- Flatpickr Script -->
    {{-- <script src="{{ asset('assets/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr.js') }}" defer></script> --}}

    {{-- <script src="{{ asset('assets/js/plugins/prism.mini.js') }}"></script> --}}

    <!-- Share Button -->
    <script>
        // Get a reference to all buttons with the class "share-button"
        var shareButtons = document.querySelectorAll('.share-button');

        // Add a click event listener to each button
        shareButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Get the value to share/copy from the "data-share" attribute
                var valueToShare = button.dataset.share;

                // Check if the Web Share API is supported
                if (navigator.share) {
                    // Call the Web Share API to open the native share dialog
                    navigator.share({
                            title: '{{ __('messages.Share your profile') }}',
                            text: valueToShare,
                            url: valueToShare,
                        })
                        .catch(err => console.error('{{ __('messages.Error sharing:') }}', err));
                } else {
                    // If the Web Share API is not supported, copy the value to the clipboard
                    navigator.clipboard.writeText(valueToShare)
                        .then(() => {
                            // If copying was successful, alert the user
                            alert('{{ __('messages.Text copied to clipboard!') }}');
                        })
                        .catch(err => {
                            // If copying failed, alert the user
                            alert('{{ __('messages.Error copying text:') }}', err);
                        });
                }
            });
        });
    </script>
</head>
<body class="{{ $colorMode ?? null }}">
    @if(!$spa)
        <!-- loader Start -->
        <div id="loading">
            <div id="loader" @if(isset($colorMode) && $colorMode == 'dark')style="background:#222738"@endif class="loader simple-loader">
                <div class="loader-body"></div>
            </div>
        </div>
        <!-- loader END -->
    @endif

    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="{{ route('panelIndex') }}" class="navbar-brand" @if($spa) wire:navigate @endif>

                <!--Logo start-->
                <div class="logo-main">
                    @if (file_exists(base_path('assets/linkstack/images/') . findFile('avatar')))
                        <div class="logo-normal">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/' . findFile('avatar')) }}"
                                style="width:auto;height:30px;">
                        </div>
                        <div class="logo-mini">
                            <img class="img logo" src="{{ asset('assets/linkstack/images/' . findFile('avatar')) }}"
                                style="width:auto;height:30px;">
                        </div>
                    @else
                        <div class="logo-normal">
                            <img class="img logo" type="image/svg+xml"
                                src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                        </div>
                        <div class="logo-mini">
                            <img class="img logo" type="image/svg+xml"
                                src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                        </div>
                    @endif
                </div>
                <!--logo End-->

                <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">{{ __('messages.Home') }}</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : 'bg-soft-primary' }}"
                            aria-current="page" href="{{ route('panelIndex') }}" wire:current="active" @if($spa) wire:navigate @endif>
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="icon-20">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.33049 2.00049H16.6695C20.0705 2.00049 21.9905 3.92949 22.0005 7.33049V16.6705C22.0005 20.0705 20.0705 22.0005 16.6695 22.0005H7.33049C3.92949 22.0005 2.00049 20.0705 2.00049 16.6705V7.33049C2.00049 3.92949 3.92949 2.00049 7.33049 2.00049ZM12.0495 17.8605C12.4805 17.8605 12.8395 17.5405 12.8795 17.1105V6.92049C12.9195 6.61049 12.7705 6.29949 12.5005 6.13049C12.2195 5.96049 11.8795 5.96049 11.6105 6.13049C11.3395 6.29949 11.1905 6.61049 11.2195 6.92049V17.1105C11.2705 17.5405 11.6295 17.8605 12.0495 17.8605ZM16.6505 17.8605C17.0705 17.8605 17.4295 17.5405 17.4805 17.1105V13.8305C17.5095 13.5095 17.3605 13.2105 17.0895 13.0405C16.8205 12.8705 16.4805 12.8705 16.2005 13.0405C15.9295 13.2105 15.7805 13.5095 15.8205 13.8305V17.1105C15.8605 17.5405 16.2195 17.8605 16.6505 17.8605ZM8.21949 17.1105C8.17949 17.5405 7.82049 17.8605 7.38949 17.8605C6.95949 17.8605 6.59949 17.5405 6.56049 17.1105V10.2005C6.53049 9.88949 6.67949 9.58049 6.95049 9.41049C7.21949 9.24049 7.56049 9.24049 7.83049 9.41049C8.09949 9.58049 8.25049 9.88949 8.21949 10.2005V17.1105Z"
                                        fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">{{ __('messages.Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(2) == 'add-link' ? 'active' : '' }}"
                            aria-current="page" href="{{ url('/studio/add-link') }}" wire:current="active" @if($spa) wire:navigate @endif>
                            <i class="icon">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z"
                                        fill="currentColor"></path>
                                    <circle cx="18" cy="11.8999" r="1" fill="currentColor"></circle>
                                </svg>

                            </i>
                            <span class="item-name">{{ __('messages.Add Link') }}</span>
                        </a>
                    </li>
                    @if (auth()->user()->role == 'admin')
                        <li class="nav-item static-item">
                            <a class="nav-link static-item disabled" href="#" tabindex="-1">
                                <span class="default-icon">{{ __('messages.Administration') }}</span>
                                <span class="mini-icon">-</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="admin-toggle" class="nav-link" data-bs-toggle="collapse" href="#admin-section" role="button"
                                aria-expanded="false" aria-controls="admin-section">
                                <i class="icon">
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M20.4023 13.58C20.76 13.77 21.036 14.07 21.2301 14.37C21.6083 14.99 21.5776 15.75 21.2097 16.42L20.4943 17.62C20.1162 18.26 19.411 18.66 18.6855 18.66C18.3278 18.66 17.9292 18.56 17.6022 18.36C17.3365 18.19 17.0299 18.13 16.7029 18.13C15.6911 18.13 14.8429 18.96 14.8122 19.95C14.8122 21.1 13.872 22 12.6968 22H11.3069C10.1215 22 9.18125 21.1 9.18125 19.95C9.16081 18.96 8.31259 18.13 7.30085 18.13C6.96361 18.13 6.65702 18.19 6.40153 18.36C6.0745 18.56 5.66572 18.66 5.31825 18.66C4.58245 18.66 3.87729 18.26 3.49917 17.62L2.79402 16.42C2.4159 15.77 2.39546 14.99 2.77358 14.37C2.93709 14.07 3.24368 13.77 3.59115 13.58C3.87729 13.44 4.06125 13.21 4.23498 12.94C4.74596 12.08 4.43937 10.95 3.57071 10.44C2.55897 9.87 2.23194 8.6 2.81446 7.61L3.49917 6.43C4.09191 5.44 5.35913 5.09 6.38109 5.67C7.27019 6.15 8.425 5.83 8.9462 4.98C9.10972 4.7 9.20169 4.4 9.18125 4.1C9.16081 3.71 9.27323 3.34 9.4674 3.04C9.84553 2.42 10.5302 2.02 11.2763 2H12.7172C13.4735 2 14.1582 2.42 14.5363 3.04C14.7203 3.34 14.8429 3.71 14.8122 4.1C14.7918 4.4 14.8838 4.7 15.0473 4.98C15.5685 5.83 16.7233 6.15 17.6226 5.67C18.6344 5.09 19.9118 5.44 20.4943 6.43L21.179 7.61C21.7718 8.6 21.4447 9.87 20.4228 10.44C19.5541 10.95 19.2475 12.08 19.7687 12.94C19.9322 13.21 20.1162 13.44 20.4023 13.58ZM9.10972 12.01C9.10972 13.58 10.4076 14.83 12.0121 14.83C13.6165 14.83 14.8838 13.58 14.8838 12.01C14.8838 10.44 13.6165 9.18 12.0121 9.18C10.4076 9.18 9.10972 10.44 9.10972 12.01Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </i>
                                <span class="item-name">{{ __('messages.Admin') }}</span>
                                <i class="right-icon">
                                    <svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </i>
                            </a>
                            <ul class="sub-nav collapse" id="admin-section" data-bs-parent="#sidebar-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'config' ? 'active' : '' }}"
                                        href="{{ url('admin/config') }}" wire:current="active" @if($spa) wire:navigate @endif>
                                        <i class="bi bi-wrench-adjustable-circle-fill"></i>
                                        <span class="item-name">{{ __('messages.Config') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'users' ? 'active' : '' }}"
                                        href="{{ url('admin/users') }}" wire:current="active" @if($spa) wire:navigate @endif>
                                        <i class="bi bi-people-fill"></i>
                                        <span class="item-name">{{ __('messages.Manage Users') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'pages' ? 'active' : '' }}"
                                        href="{{ url('admin/pages') }}" wire:current="active" @if($spa) wire:navigate @endif>
                                        <i class="bi bi-collection-fill"></i>
                                        <span class="item-name">{{ __('messages.Footer Pages') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::segment(2) == 'site' ? 'active' : '' }}"
                                        href="{{ url('admin/site') }}" wire:current="active" @if($spa) wire:navigate @endif>
                                        <i class="bi bi-palette-fill"></i>
                                        <span class="item-name">{{ __('messages.Site Customization') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">{{ __('messages.Personalization') }}</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(2) == 'links' ? 'active' : '' }}"
                            href="{{ url('/studio/links') }}" wire:current="active" @if($spa) wire:navigate @endif>
                            <i class="icon">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.54 2H7.92C9.33 2 10.46 3.15 10.46 4.561V7.97C10.46 9.39 9.33 10.53 7.92 10.53H4.54C3.14 10.53 2 9.39 2 7.97V4.561C2 3.15 3.14 2 4.54 2ZM4.54 13.4697H7.92C9.33 13.4697 10.46 14.6107 10.46 16.0307V19.4397C10.46 20.8497 9.33 21.9997 7.92 21.9997H4.54C3.14 21.9997 2 20.8497 2 19.4397V16.0307C2 14.6107 3.14 13.4697 4.54 13.4697ZM19.4601 2H16.0801C14.6701 2 13.5401 3.15 13.5401 4.561V7.97C13.5401 9.39 14.6701 10.53 16.0801 10.53H19.4601C20.8601 10.53 22.0001 9.39 22.0001 7.97V4.561C22.0001 3.15 20.8601 2 19.4601 2ZM16.0801 13.4697H19.4601C20.8601 13.4697 22.0001 14.6107 22.0001 16.0307V19.4397C22.0001 20.8497 20.8601 21.9997 19.4601 21.9997H16.0801C14.6701 21.9997 13.5401 20.8497 13.5401 19.4397V16.0307C13.5401 14.6107 14.6701 13.4697 16.0801 13.4697Z"
                                        fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">{{ __('messages.Links') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(2) == 'page' ? 'active' : '' }}"
                            href="{{ url('/studio/page') }}" wire:current="active" wire:current="active" @if($spa) wire:navigate @endif>
                            <i class="icon">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.6653 2.01034C18.1038 1.92043 19.5224 2.41991 20.5913 3.3989C21.5703 4.46779 22.0697 5.88633 21.9898 7.33483V16.6652C22.0797 18.1137 21.5703 19.5322 20.6013 20.6011C19.5323 21.5801 18.1038 22.0796 16.6653 21.9897H7.33487C5.88636 22.0796 4.46781 21.5801 3.39891 20.6011C2.41991 19.5322 1.92043 18.1137 2.01034 16.6652V7.33483C1.92043 5.88633 2.41991 4.46779 3.39891 3.3989C4.46781 2.41991 5.88636 1.92043 7.33487 2.01034H16.6653ZM10.9811 16.845L17.7042 10.102C18.3136 9.4826 18.3136 8.48364 17.7042 7.87427L16.4056 6.57561C15.7862 5.95625 14.7872 5.95625 14.1679 6.57561L13.4985 7.25491C13.3986 7.35481 13.3986 7.52463 13.4985 7.62453C13.4985 7.62453 15.0869 9.20289 15.1169 9.24285C15.2268 9.36273 15.2967 9.52256 15.2967 9.70238C15.2967 10.062 15.007 10.3617 14.6374 10.3617C14.4675 10.3617 14.3077 10.2918 14.1978 10.1819L12.5295 8.5236C12.4496 8.44368 12.3098 8.44368 12.2298 8.5236L7.46474 13.2887C7.13507 13.6183 6.94527 14.0579 6.93528 14.5274L6.87534 16.8949C6.87534 17.0248 6.9153 17.1447 7.00521 17.2346C7.09512 17.3245 7.21499 17.3744 7.34486 17.3744H9.69245C10.172 17.3744 10.6315 17.1846 10.9811 16.845Z"
                                        fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">{{ __('messages.Appearance') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(2) == 'theme' ? 'active' : '' }}"
                            href="{{ url('/studio/theme') }}" wire:current="active" @if($spa) wire:navigate @endif>
                            <i class="icon">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.63751 3.39549C5.06051 3.39549 3.39551 5.16249 3.39551 7.88849V16.1025C3.39551 16.8675 3.53751 17.5505 3.78051 18.1415C3.791 18.129 4.01986 17.8501 4.3184 17.4863C4.90188 16.7752 5.75156 15.7398 5.75751 15.7345C6.44951 14.9445 7.74851 13.7665 9.45351 14.4795C9.82712 14.6344 10.1592 14.8466 10.4649 15.042C10.4947 15.061 10.5242 15.0799 10.5535 15.0985C11.1265 15.4815 11.4635 15.6615 11.8135 15.6315C11.9585 15.6115 12.0945 15.5685 12.2235 15.4885C12.7101 15.1885 13.9718 13.4009 14.3496 12.8656C14.405 12.7871 14.4414 12.7355 14.4535 12.7195C15.5435 11.2995 17.2235 10.9195 18.6235 11.7595C18.8115 11.8715 20.1585 12.8125 20.6045 13.1905V7.88849C20.6045 5.16249 18.9395 3.39549 16.3535 3.39549H7.63751ZM16.3535 2.00049C19.7305 2.00049 21.9995 4.36249 21.9995 7.88849V16.1025C21.9995 16.1912 21.9902 16.2743 21.9809 16.3574C21.9744 16.4159 21.9678 16.4742 21.9645 16.5345C21.9624 16.5709 21.9613 16.6073 21.9603 16.6438C21.9589 16.6923 21.9575 16.7409 21.9535 16.7895C21.9515 16.8085 21.9478 16.8267 21.944 16.845C21.9403 16.8632 21.9365 16.8815 21.9345 16.9005C21.9015 17.2145 21.8505 17.5145 21.7795 17.8055C21.7627 17.8782 21.7433 17.9483 21.7238 18.0191L21.7195 18.0345C21.6395 18.3165 21.5455 18.5855 21.4325 18.8425C21.4127 18.8857 21.3918 18.9278 21.3709 18.9699C21.357 18.998 21.3431 19.0261 21.3295 19.0545C21.2075 19.2995 21.0755 19.5345 20.9225 19.7525C20.8942 19.7928 20.8641 19.8307 20.8339 19.8685C20.814 19.8936 20.794 19.9186 20.7745 19.9445C20.6155 20.1505 20.4495 20.3475 20.2615 20.5265C20.224 20.5622 20.1834 20.5948 20.1428 20.6275C20.1175 20.6479 20.0921 20.6683 20.0675 20.6895C19.8745 20.8555 19.6775 21.0145 19.4605 21.1505C19.4132 21.1802 19.3628 21.2052 19.3127 21.2301C19.2803 21.2462 19.2479 21.2622 19.2165 21.2795C18.9955 21.4015 18.7725 21.5205 18.5295 21.6125C18.4711 21.6347 18.4088 21.6508 18.3465 21.6669C18.3021 21.6783 18.2577 21.6898 18.2145 21.7035C18.1929 21.7102 18.1713 21.7169 18.1497 21.7236C17.9326 21.7912 17.7162 21.8585 17.4825 21.8985C17.3471 21.9222 17.2034 21.9313 17.0596 21.9405C16.9974 21.9444 16.9351 21.9484 16.8735 21.9535C16.8073 21.9584 16.7423 21.9664 16.6773 21.9744C16.5716 21.9874 16.4656 22.0005 16.3535 22.0005H7.63751C7.26151 22.0005 6.90251 21.9625 6.55551 21.9055C6.54251 21.9035 6.53051 21.9015 6.51851 21.8995C5.16551 21.6665 4.04251 21.0135 3.25551 20.0285C3.25005 20.0285 3.2479 20.0248 3.24504 20.0199C3.24319 20.0167 3.24105 20.013 3.23751 20.0095C2.44651 19.0135 1.99951 17.6745 1.99951 16.1025V7.88849C1.99951 4.36249 4.27051 2.00049 7.63751 2.00049H16.3535ZM11.0001 8.51505C11.0001 9.87 9.86639 11.0001 8.50496 11.0001C7.30825 11.0001 6.2879 10.1257 6.05922 8.99372C6.02143 8.82387 6.00011 8.64919 6.00011 8.46872C6.00011 7.10412 7.10864 6.00009 8.47879 6.00009C9.17647 6.00009 9.80825 6.29347 10.2608 6.76152C10.7152 7.21317 11.0001 7.83564 11.0001 8.51505Z"
                                        fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">{{ __('messages.Themes') }}</span>
                        </a>
                    </li>
                </ul>
                </li>
                </ul>
                <!-- Sidebar Menu End -->
            </div>
        </div>
        <div class="sidebar-footer"></div>
    </aside>
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="{{ route('panelIndex') }}" class="navbar-brand">

                        <!--Logo start-->
                        <div class="logo-main">
                            @if (file_exists(base_path('assets/linkstack/images/') . findFile('avatar')))
                                <div class="logo-normal">
                                    <img class="img logo"
                                        src="{{ asset('assets/linkstack/images/' . findFile('avatar')) }}"
                                        style="width:auto;height:30px;">
                                </div>
                                <div class="logo-mini">
                                    <img class="img logo"
                                        src="{{ asset('assets/linkstack/images/' . findFile('avatar')) }}"
                                        style="width:auto;height:30px;">
                                </div>
                            @else
                                <div class="logo-normal">
                                    <img class="img logo" type="image/svg+xml"
                                        src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px"
                                        height="30px">
                                </div>
                                <div class="logo-mini">
                                    <img class="img logo" type="image/svg+xml"
                                        src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px"
                                        height="30px">
                                </div>
                            @endif
                        </div>
                        <!--logo End-->


                        <h4 class="logo-title">{{ env('APP_NAME') }}</h4>
                    </a>
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    {{-- <div class="input-group search-input">
              <span class="input-group-text" id="search-input">
                <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </span>
              <input type="search" class="form-control" placeholder="Search...">
            </div> --}}
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                    <a target="_blank" href="{{ url('/@' . Auth::user()->littlelink_name) }}">
                                        <button style="border-bottom-right-radius:0;border-top-right-radius:0;"
                                            type="button"
                                            class="btn btn-primary btn-sm pe-2">{{ __('messages.View Page') }}</button>
                                    </a>
                                    <button style="border-bottom-left-radius:0;border-top-left-radius:0;"
                                        class="btn btn-primary btn-sm dropdown-toggle ms-auto px-1" type="button"
                                        id="dropdownMenuButtonSM" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="btn-seg-ico bi bi-share-fill"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonSM">
                                        <li>
                                            <h6 class="dropdown-header">{{ __('messages.Share your profile:') }}</h6>
                                        </li>
                                        @if (env('SUPPORTED_DOMAINS') !== '' and env('SUPPORTED_DOMAINS') !== null)
                                            @php
                                                $sDomains = str_replace(' ', '', env('SUPPORTED_DOMAINS'));
                                                $sDomains = explode(',', $sDomains);
                                            @endphp
                                            @foreach ($sDomains as $myvar)
                                                <li>
                                                    <a class="dropdown-item share-button"
                                                        style="cursor:pointer!important;"
                                                        data-share="{{ 'https://' . $myvar . '/@' . Auth::user()->littlelink_name }}">
                                                        <i class="bi bi-files"></i> {{ $myvar }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @else
                                            <li><a class="dropdown-item share-button"
                                                    style="cursor:pointer!important;"
                                                    data-share="{{ url('') . '/@' . Auth::user()->littlelink_name }}"><i
                                                        class="bi bi-files"></i>
                                                    {{ str_replace(['http://', 'https://'], '', url('')) }} </a></li>
                                        @endif
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                style="cursor:pointer!important;" data-bs-target="#staticBackdrop"><i
                                                    class="bi bi-qr-code-scan"></i> {{ __('messages.QR Code') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li id="notifications" class="nav-item dropdown">
                                <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                                  <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none"
                                      xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M19.7695 11.6453C19.039 10.7923 18.7071 10.0531 18.7071 8.79716V8.37013C18.7071 6.73354 18.3304 5.67907 17.5115 4.62459C16.2493 2.98699 14.1244 2 12.0442 2H11.9558C9.91935 2 7.86106 2.94167 6.577 4.5128C5.71333 5.58842 5.29293 6.68822 5.29293 8.37013V8.79716C5.29293 10.0531 4.98284 10.7923 4.23049 11.6453C3.67691 12.2738 3.5 13.0815 3.5 13.9557C3.5 14.8309 3.78723 15.6598 4.36367 16.3336C5.11602 17.1413 6.17846 17.6569 7.26375 17.7466C8.83505 17.9258 10.4063 17.9933 12.0005 17.9933C13.5937 17.9933 15.165 17.8805 16.7372 17.7466C17.8215 17.6569 18.884 17.1413 19.6363 16.3336C20.2118 15.6598 20.5 14.8309 20.5 13.9557C20.5 13.0815 20.3231 12.2738 19.7695 11.6453Z"
                                          fill="currentColor"></path>
                                      <path opacity="0.4"
                                          d="M14.0088 19.2283C13.5088 19.1215 10.4627 19.1215 9.96275 19.2283C9.53539 19.327 9.07324 19.5566 9.07324 20.0602C9.09809 20.5406 9.37935 20.9646 9.76895 21.2335L9.76795 21.2345C10.2718 21.6273 10.8632 21.877 11.4824 21.9667C11.8123 22.012 12.1482 22.01 12.4901 21.9667C13.1083 21.877 13.6997 21.6273 14.2036 21.2345L14.2026 21.2335C14.5922 20.9646 14.8734 20.5406 14.8983 20.0602C14.8983 19.5566 14.4361 19.327 14.0088 19.2283Z"
                                          fill="currentColor"></path>
                                  </svg>
                                  <span class="bg-danger dots"></span>
                              </a>
                            </li>

                            @if (env('NOTIFY_UPDATES') == 'true' or env('NOTIFY_UPDATES') === 'major' or env('NOTIFY_UPDATES') === 'all')

                                {{-- <! –– Checks if file version.json exists AND if version.json exists on server to continue (without this PHP will throw ErrorException ) ––> --}}
                                @if (file_exists(base_path('version.json')))

                                    @php
                                        $Vlocal = file_get_contents(base_path('version.json'));
                                    @endphp

                                    <script>
                                        $(document).ready(function() {
                                            async function fetchAndReplaceContent() {
                                                try {
                                                    var response = await $.ajax({
                                                        url: "{{ url('/dashboard/notifications') }}",
                                                        method: 'GET',
                                                        dataType: 'html'
                                                    });
                                                    $('#notifications').html(response);
                                                } catch (error) {
                                                    console.error('Error fetching content:', error);
                                                }
                                            }

                                            fetchAndReplaceContent();
                                        });
                                    </script>

                                    @php 
                                    if(isset($_GET['dismiss'])) {
                                        $dismiss = $_GET['dismiss'];
                                        $param = str_replace('dismiss=', '', $dismiss);
                                        UserData::saveData($user->id, $param, true);
                                        exit(header("Location: " . url()->current()));
                                    }
                                    @endphp

                                    {{-- Notification Modals --}}
                                    @push('sidebar-scripts')
                                        @php
                                            function notification($adminOnly = false, $dismiss = '', $ntid, $heading, $body)
                                            {
                                                $closeMSG = __('messages.Close');
                                                $dismissMSG = __('messages.Dismiss');
                                                $dismissBtn = '';
                                                if ($dismiss) {
                                                    $dismissBtn = '<a href="' . url()->current() . '?dismiss=' . $dismiss . '" class="btn btn-danger">' . $dismissMSG . '</a>';
                                                }
$body = <<<MODAL
    <div class="modal fade" id="$ntid" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="${ntid}-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="${ntid}-label">$heading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="bd-example">
                        $body
                    </div>
                </div>
                <div class="modal-footer">
                    $dismissBtn
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">$closeMSG</button>
                </div>
            </div>
        </div>
    </div>
MODAL; // <-- Indentation breaks my code editor :/

                                                if (!$adminOnly || Auth::user()->role == 'admin') {
                                                    echo $body;
                                                }

                                            }
                                            notification(true, '', 'modal-1', __('messages.Your security is at risk!'), '<b>' . __('messages.security.msg1') . '</b> ' . __('messages.security.msg2') . '<br><br>' . __('messages.security.msg3') . '<br><a href="' . url('admin/config#5') . '">' . __('messages.security.msg3') . '</a>.');
                                            notification(true, 'hide-star-notification', 'modal-star', __('messages.Support Linkstack'), '' . __('messages.support.msg1') . ' <a target="_blank" href="https://github.com/linkstackorg/linkstack">' . __('messages.support.msg2') . '</a>. ' . __('messages.support.msg3') . '<br><br>' . __('messages.support.msg4') . ' <a target="_blank" href="https://linkstack.org/donate">' . __('messages.support.msg5') . '<br><br>' . __('messages.support.msg6') . '');
                                        @endphp
                                    @endpush

                                    {{-- <! –– #### begin update detection #### ––> --}}
                                    @if(auth()->user()->role == 'admin')
                                    <script>
                                        var isVisible = true;

                                        async function externalFileGetContents(url) {
                                            try {
                                                var response = await fetch(url, {
                                                    method: 'GET',
                                                    redirect: 'follow' // This ensures that redirects are followed
                                                });

                                                if (!response.ok) {
                                                    console.error(`Error fetching the URL: ${response.statusText}`);
                                                    return null;
                                                }

                                                var data = await response.text();
                                                return data.trim();
                                            } catch (error) {
                                                console.error(`Error fetching the URL: ${error.message}`);
                                                return null;
                                            }
                                        }

                                        function changeLocation(isVisible) {
                                            if (isVisible) {
                                                window.location.href = "{{ url('update') }}";
                                            } else {
                                                window.location.href = "{{ url()->current() }}";
                                            }
                                        }
                                    </script>

                                @if (env('JOIN_BETA') == true)
                                    <script>                             
                                        (async function() {
                                            async function updateBetaVersion() {
                                                var Vbeta = await externalFileGetContents('{{"{$betaServer}vbeta.json"}}');
                                                var isVisible = true;
                                            
                                                document.getElementById('beta-version').textContent = Vbeta;
                                            
                                                var updateElements = document.getElementsByClassName('update-icon-update');
                                                var normalElements = document.getElementsByClassName('update-icon-normal');
                                            
                                                for (var i = 0; i < updateElements.length; i++) {
                                                    updateElements[i].style.display = isVisible ? 'block' : 'none';
                                                    normalElements[i].style.display = 'none';
                                                }
                                            }
                                        
                                            document.addEventListener('DOMContentLoaded', updateBetaVersion);
                                            document.addEventListener('livewire:navigated', updateBetaVersion);
                                        })();
                                    </script>
                                @else
                                    <script>                                
                                        (async function() {
                                            async function updateVersionIcons() {
                                                var Vgit = await externalFileGetContents('{{$versionServer}}');
                                                var Vlocal = `{{ trim($Vlocal) }}`;
                                            
                                                var isVisible = Vgit > Vlocal;
                                            
                                                var updateElements = document.getElementsByClassName('update-icon-update');
                                                var normalElements = document.getElementsByClassName('update-icon-normal');
                                            
                                                for (var i = 0; i < updateElements.length; i++) {
                                                    updateElements[i].style.display = isVisible ? 'block' : 'none';
                                                    normalElements[i].style.display = 'none';
                                                }
                                            
                                                for (var i = 0; i < normalElements.length; i++) {
                                                    normalElements[i].style.display = isVisible ? 'none' : 'block';
                                                }
                                            }
                                        
                                            document.addEventListener('DOMContentLoaded', updateVersionIcons);
                                            document.addEventListener('livewire:navigated', updateVersionIcons);
                                        })();
                                    </script>
                                @endif

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="mail-drop"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg style="display:none" class="update-icon-update icon-24"
                                            width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22 7.92V16.09C22 19.62 19.729 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2H16.34C19.729 2 22 4.38 22 7.92ZM11.25 9.73V16.08C11.25 16.5 11.59 16.83 12 16.83C12.42 16.83 12.75 16.5 12.75 16.08V9.73L15.22 12.21C15.36 12.35 15.56 12.43 15.75 12.43C15.939 12.43 16.13 12.35 16.28 12.21C16.57 11.92 16.57 11.44 16.28 11.15L12.53 7.38C12.25 7.1 11.75 7.1 11.47 7.38L7.72 11.15C7.43 11.44 7.43 11.92 7.72 12.21C8.02 12.5 8.49 12.5 8.79 12.21L11.25 9.73Z"
                                                fill="currentColor"></path>
                                            <circle cx="18" cy="17" r="5" fill="tomato"
                                                stroke="white" stroke-width="2" />
                                        </svg>
                                        <svg style="display:block" class="update-icon-normal icon-24"
                                            width="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22 7.92V16.09C22 19.62 19.729 22 16.34 22H7.67C4.28 22 2 19.62 2 16.09V7.92C2 4.38 4.28 2 7.67 2H16.34C19.729 2 22 4.38 22 7.92ZM11.25 9.73V16.08C11.25 16.5 11.59 16.83 12 16.83C12.42 16.83 12.75 16.5 12.75 16.08V9.73L15.22 12.21C15.36 12.35 15.56 12.43 15.75 12.43C15.939 12.43 16.13 12.35 16.28 12.21C16.57 11.92 16.57 11.44 16.28 11.15L12.53 7.38C12.25 7.1 11.75 7.1 11.47 7.38L7.72 11.15C7.43 11.44 7.43 11.92 7.72 12.21C8.02 12.5 8.49 12.5 8.79 12.21L11.25 9.73Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <span class="bg-primary count-mail"></span>
                                    </a>
                                    <div class="p-0 sub-drop dropdown-menu dropdown-menu-end"
                                        aria-labelledby="mail-drop">
                                        <div class="m-0 shadow-none card">
                                            @if (env('JOIN_BETA') == true)
                                                <div
                                                    class="py-3 card-header d-flex justify-content-between bg-primary">
                                                    <div class="header-title">
                                                        <h5 class="mb-0 text-white">
                                                            {{ __('messages.Updater') }} <span
                                                                style="background-color:orange;"
                                                                class="badge">{{ __('messages.Beta Mode') }}</span>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="p-0 card-body rounded-bottom">
                                                    <a href="{{ url('update') }}" class="iq-sub-card">
                                                        <div class="d-flex align-items-center">
                                                            <table class="m-0 table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ __('messages.Local version') }}
                                                                        </th>
                                                                        <th>{{ __('messages.Latest beta') }}
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <center><span
                                                                                    class="badge rounded-pill bg-primary"><?php if (file_exists(base_path('vbeta.json'))) {
                                                                                        echo file_get_contents(base_path('vbeta.json'));
                                                                                    } else {
                                                                                        echo 'none';
                                                                                    } ?></span>
                                                                            </center>
                                                                        </td>
                                                                        <td>
                                                                            <center><span id="beta-version" class="badge rounded-pill bg-primary"></span>
                                                                            </center>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <center><button
                                                                class="btn btn-primary rounded-pill mt-2">{{ __('messages.Run updater') }}</button>
                                                        </center>
                                                    </a>
                                                </div>
                                            @else
                                                <div
                                                    class="py-3 card-header d-flex justify-content-between bg-primary">
                                                    <div class="header-title">
                                                        <h5 class="mb-0 text-white">
                                                            {{ __('messages.Updater') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="p-0 card-body rounded-bottom">
                                                    <a onclick="changeLocation(isVisible)"
                                                        class="iq-sub-card">
                                                        <div class="d-flex align-items-center">
                                                            <svg class="icon-32" width="32"
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.0122 14.8299C10.4077 14.8299 9.10986 13.5799 9.10986 12.0099C9.10986 10.4399 10.4077 9.17993 12.0122 9.17993C13.6167 9.17993 14.8839 10.4399 14.8839 12.0099C14.8839 13.5799 13.6167 14.8299 12.0122 14.8299Z"
                                                                    fill="currentColor"></path>
                                                                <path opacity="0.4"
                                                                    d="M21.2301 14.37C21.036 14.07 20.76 13.77 20.4023 13.58C20.1162 13.44 19.9322 13.21 19.7687 12.94C19.2475 12.08 19.5541 10.95 20.4228 10.44C21.4447 9.87 21.7718 8.6 21.179 7.61L20.4943 6.43C19.9118 5.44 18.6344 5.09 17.6226 5.67C16.7233 6.15 15.5685 5.83 15.0473 4.98C14.8838 4.7 14.7918 4.4 14.8122 4.1C14.8429 3.71 14.7203 3.34 14.5363 3.04C14.1582 2.42 13.4735 2 12.7172 2H11.2763C10.5302 2.02 9.84553 2.42 9.4674 3.04C9.27323 3.34 9.16081 3.71 9.18125 4.1C9.20169 4.4 9.10972 4.7 8.9462 4.98C8.425 5.83 7.27019 6.15 6.38109 5.67C5.35913 5.09 4.09191 5.44 3.49917 6.43L2.81446 7.61C2.23194 8.6 2.55897 9.87 3.57071 10.44C4.43937 10.95 4.74596 12.08 4.23498 12.94C4.06125 13.21 3.87729 13.44 3.59115 13.58C3.24368 13.77 2.93709 14.07 2.77358 14.37C2.39546 14.99 2.4159 15.77 2.79402 16.42L3.49917 17.62C3.87729 18.26 4.58245 18.66 5.31825 18.66C5.66572 18.66 6.0745 18.56 6.40153 18.36C6.65702 18.19 6.96361 18.13 7.30085 18.13C8.31259 18.13 9.16081 18.96 9.18125 19.95C9.18125 21.1 10.1215 22 11.3069 22H12.6968C13.872 22 14.8122 21.1 14.8122 19.95C14.8429 18.96 15.6911 18.13 16.7029 18.13C17.0299 18.13 17.3365 18.19 17.6022 18.36C17.9292 18.56 18.3278 18.66 18.6855 18.66C19.411 18.66 20.1162 18.26 20.4943 17.62L21.2097 16.42C21.5776 15.75 21.6083 14.99 21.2301 14.37Z"
                                                                    fill="currentColor"></path>
                                                            </svg>
                                                            <div class="ms-3 w-100">
                                                                <h6 class="mb-0 update-icon-update">
                                                                    {{ __('messages.Update available') }}
                                                                </h6>
                                                                <h6 class="mb-0 update-icon-normal">
                                                                    {{ __('messages.Up to date') }}
                                                                </h6>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-0 update-icon-update"><i>
                                                                            {{ __('messages.Run updater') }}
                                                                        </i></p>
                                                                    <p class="mb-0 update-icon-normal"><i>
                                                                            {{ __('messages.Check again') }}
                                                                        </i></p>
                                                                    <small
                                                                        class="float-end font-size-12">v{{ $Vlocal }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif
                            {{-- <! –– #### end update detection #### ––> --}}

                            @endif

                            @endif

                            <li class="nav-item dropdown">
                                <a class="py-0 nav-link d-flex align-items-center dropdown-toggle" href="#"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false" data-bs-target="#navbarDropdownIcon">
                                    @if (file_exists(base_path(findAvatar(Auth::user()->id))))
                                        <img src="{{ url(findAvatar(Auth::user()->id)) }}" alt="User-Profile"
                                            class="img-fluid avatar avatar-40 avatar-rounded"
                                            style="object-fit:cover;">
                                    @elseif(file_exists(base_path('assets/linkstack/images/') . findFile('avatar')))
                                        <img src="{{ url('assets/linkstack/images/') . '/' . findFile('avatar') }}"
                                            alt="User-Profile" class="img logo" style="width:auto;height:30px;">
                                    @else
                                        <img src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="User-Profile"
                                            class="img-fluid avatar avatar-40 avatar-rounded">
                                    @endif
                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title">{{ Auth::user()->name }}</h6>
                                        <p class="mb-0 caption-sub-title">
                                            @if (Auth::user()->role == 'admin')
                                                {{ __('messages.Administrator') }}
                                            @elseif(Auth::user()->role == 'vip')
                                                {{ __('messages.Verified user') }}
                                            @else
                                                {{ __('messages.User') }}
                                            @endif
                                        </p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ url('/studio/page') }}" @if($spa) wire:navigate @endif><i
                                                class="bi bi-person-fill"></i> {{ __('messages.Profile') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/studio/profile') }}" @if($spa) wire:navigate @endif><i
                                                class="bi bi-gear-fill"></i> {{ __('messages.Settings') }}</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasExample" role="button"
                                            aria-controls="offcanvasExample"><i class="bi bi-brush-fill"></i>
                                            {{ __('messages.Styling') }}</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="dropdown-item"
                                                href="{{ route('logout') }}"><i class="bi bi-box-arrow-in-left"></i>
                                                {{ __('messages.Logout') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> <!-- Nav Header Component Start -->
            <style>
                .header-block {
                    background-color: var(--bs-primary);
                    border-bottom-left-radius: 1rem;
                    border-bottom-right-radius: 1rem;
                }
            </style>
            <div class="iq-navbar-header header-block mb-2" style="height: 205px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="z-index:5;position:relative;"
                                class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    @if (!isset($usrhandl))
                                        <h1>👋 {{ __('messages.Hi') }}, {{ __('messages.stranger') }}</h1>
                                    @else
                                        <h1>👋 {{ __('messages.Hi') }}, {{ '@' . $usrhandl }}</h1>
                                    @endif

                                    <h5>{{ __('messages.welcome', ['appName' => config('app.name')]) }}</h5>
                                </div>
                                <div>
                                    @if (!isset($usrhandl))
                                        <a href="{{ url('/studio/page') }}" class="btn btn-link btn-soft-light">
                                            <i style="top:3px;position:relative;font-size:2.5vh;"
                                                class="bi bi-at"></i>
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
                        if (file_exists(base_path('assets/dashboard-themes/header.png'))) {
                            $headerImage = asset('assets/dashboard-themes/header.png');
                        } else {
                            $headerImage = asset('assets/images/dashboard/top-header-overlay.png');
                        }
                    @endphp
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="{{ $headerImage }}" draggable="false" alt="header"
                        class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->

            @yield('content')

            <!-- Footer Section Start -->
            <footer class="footer">
                <div class="footer-body">
                    <ul class="left-panel list-inline mb-0 p-0">
                        @if (env('DISPLAY_FOOTER') === true)
                            @if (env('DISPLAY_FOOTER_HOME') === true)
                                <li class="list-inline-item"><a class="list-inline-item"
                                        href="@if (str_replace('"', '', EnvEditor::getKey('HOME_FOOTER_LINK')) === '') {{ url('') }}@else{{ str_replace('"', '', EnvEditor::getKey('HOME_FOOTER_LINK')) }} @endif">{{ footer('Home') }}</a>
                                </li>
                            @endif
                            @if (env('DISPLAY_FOOTER_TERMS') === true)
                                <li class="list-inline-item"><a class="list-inline-item"
                                        href="{{ url('') }}/pages/{{ strtolower(footer('Terms')) }}">{{ footer('Terms') }}</a>
                                </li>
                            @endif
                            @if (env('DISPLAY_FOOTER_PRIVACY') === true)
                                <li class="list-inline-item"><a class="list-inline-item"
                                        href="{{ url('') }}/pages/{{ strtolower(footer('Privacy')) }}">{{ footer('Privacy') }}</a>
                                </li>
                            @endif
                            @if (env('DISPLAY_FOOTER_CONTACT') === true)
                                <li class="list-inline-item"><a class="list-inline-item"
                                        href="{{ url('') }}/pages/{{ strtolower(footer('Contact')) }}">{{ footer('Contact') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                    <div class="right-panel">
                        {{ __('messages.Copyright') }} &copy; @php echo date('Y'); @endphp {{ config('app.name') }}
                        @if (env('DISPLAY_CREDIT_FOOTER') === true)
                            <span class="">
                                - {{ __('messages.Made with') }}
                                <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span> {{ __('messages.by') }} <a href="https://linkstack.org/"
                                target="_blank">LinkStack</a>.
                        @endif
                    </div>
                </div>
            </footer>
            <!-- Footer Section End -->
    </main>

    <!-- offcanvas start -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" data-bs-scroll="true"
        data-bs-backdrop="true" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <div class="d-flex align-items-center">
                <h3 class="offcanvas-title me-3" id="offcanvasExampleLabel">{{ __('messages.Settings') }}</h3>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body data-scrollbar">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mb-3">{{ __('messages.Scheme') }}</h5>
                    <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div class="btn btn-border" data-setting="color-mode" data-name="color" data-value="auto">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor" d="M7,2V13H10V22L17,10H13L17,2H7Z" />
                            </svg>
                            <span class="ms-2 "> {{ __('messages.Auto') }} </span>
                        </div>

                        <div class="btn btn-border" data-setting="color-mode" data-name="color" data-value="dark">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M9,2C7.95,2 6.95,2.16 6,2.46C10.06,3.73 13,7.5 13,12C13,16.5 10.06,20.27 6,21.54C6.95,21.84 7.95,22 9,22A10,10 0 0,0 19,12A10,10 0 0,0 9,2Z" />
                            </svg>
                            <span class="ms-2 "> {{ __('messages.Dark') }} </span>
                        </div>
                        <div class="btn btn-border active" data-setting="color-mode" data-name="color"
                            data-value="light">
                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z" />
                            </svg>
                            <span class="ms-2 "> {{ __('messages.Light') }}</span>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="mt-4 mb-3">{{ __('messages.Color Customizer') }}</h5>
                        <button class="btn btn-transparent p-0 border-0" data-value="theme-color-default"
                            data-info="#079aa2" data-setting="color-mode1" data-name="color"
                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Default">
                            <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21.4799 12.2424C21.7557 12.2326 21.9886 12.4482 21.9852 12.7241C21.9595 14.8075 21.2975 16.8392 20.0799 18.5506C18.7652 20.3986 16.8748 21.7718 14.6964 22.4612C12.518 23.1505 10.1711 23.1183 8.01299 22.3694C5.85488 21.6205 4.00382 20.196 2.74167 18.3126C1.47952 16.4293 0.875433 14.1905 1.02139 11.937C1.16734 9.68346 2.05534 7.53876 3.55018 5.82945C5.04501 4.12014 7.06478 2.93987 9.30193 2.46835C11.5391 1.99683 13.8711 2.2599 15.9428 3.2175L16.7558 1.91838C16.9822 1.55679 17.5282 1.62643 17.6565 2.03324L18.8635 5.85986C18.945 6.11851 18.8055 6.39505 18.549 6.48314L14.6564 7.82007C14.2314 7.96603 13.8445 7.52091 14.0483 7.12042L14.6828 5.87345C13.1977 5.18699 11.526 4.9984 9.92231 5.33642C8.31859 5.67443 6.8707 6.52052 5.79911 7.74586C4.72753 8.97119 4.09095 10.5086 3.98633 12.1241C3.8817 13.7395 4.31474 15.3445 5.21953 16.6945C6.12431 18.0446 7.45126 19.0658 8.99832 19.6027C10.5454 20.1395 12.2278 20.1626 13.7894 19.6684C15.351 19.1743 16.7062 18.1899 17.6486 16.8652C18.4937 15.6773 18.9654 14.2742 19.0113 12.8307C19.0201 12.5545 19.2341 12.3223 19.5103 12.3125L21.4799 12.2424Z"
                                    fill="#31BAF1" />
                                <path
                                    d="M20.0941 18.5594C21.3117 16.848 21.9736 14.8163 21.9993 12.7329C22.0027 12.4569 21.7699 12.2413 21.4941 12.2512L19.5244 12.3213C19.2482 12.3311 19.0342 12.5633 19.0254 12.8395C18.9796 14.283 18.5078 15.6861 17.6628 16.8739C16.7203 18.1986 15.3651 19.183 13.8035 19.6772C12.2419 20.1714 10.5595 20.1483 9.01246 19.6114C7.4654 19.0746 6.13845 18.0534 5.23367 16.7033C4.66562 15.8557 4.28352 14.9076 4.10367 13.9196C4.00935 18.0934 6.49194 21.37 10.008 22.6416C10.697 22.8908 11.4336 22.9852 12.1652 22.9465C13.075 22.8983 13.8508 22.742 14.7105 22.4699C16.8889 21.7805 18.7794 20.4073 20.0941 18.5594Z"
                                    fill="#0169CA" />
                            </svg>
                        </button>
                    </div>
                    <div class="grid-cols-5 mb-4 d-grid gap-x-2">
                        <div class="btn btn-border bg-transparent" data-value="theme-color-blue" data-info="#573BFF"
                            data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="" data-bs-original-title="Theme-1">
                            <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="32">
                                <circle cx="12" cy="12" r="10" fill="#00C3F9" />
                                <path d="M2,12 a1,1 1 1,0 20,0" fill="#573BFF" />
                            </svg>
                        </div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-gray" data-info="#FD8D00"
                            data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="" data-bs-original-title="Theme-2">
                            <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="32">
                                <circle cx="12" cy="12" r="10" fill="#91969E" />
                                <path d="M2,12 a1,1 1 1,0 20,0" fill="#FD8D00" />
                            </svg>
                        </div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-red" data-info="#366AF0"
                            data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="" data-bs-original-title="Theme-3">
                            <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="32">
                                <circle cx="12" cy="12" r="10" fill="#DB5363" />
                                <path d="M2,12 a1,1 1 1,0 20,0" fill="#366AF0" />
                            </svg>
                        </div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-yellow"
                            data-info="#6410F1" data-setting="color-mode1" data-name="color"
                            data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Theme-4">
                            <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="32">
                                <circle cx="12" cy="12" r="10" fill="#EA6A12" />
                                <path d="M2,12 a1,1 1 1,0 20,0" fill="#6410F1" />
                            </svg>
                        </div>
                        <div class="btn btn-border bg-transparent" data-value="theme-color-pink" data-info="#25C799"
                            data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="" data-bs-original-title="Theme-5">
                            <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" width="32">
                                <circle cx="12" cy="12" r="10" fill="#E586B3" />
                                <path d="M2,12 a1,1 1 1,0 20,0" fill="#25C799" />
                            </svg>
                        </div>

                    </div>
                    {{-- <hr class="hr-horizontal">
            <h5 class="mb-3 mt-4">Scheme Direction</h5>
            <div class="d-grid gap-3 grid-cols-2 mb-4">
              <div class="text-center">
                <img src="{{asset('assets/images/settings/dark/01.png')}}" alt="ltr" class="mode dark-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="dir-mode" data-name="dir" data-value="ltr">
                <img src="{{asset('assets/images/settings/light/01.png')}}" alt="ltr" class="mode light-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="dir-mode" data-name="dir" data-value="ltr">
                <span class=" mt-2"> LTR </span>
              </div>
               <div class="text-center">
                 <img src="{{asset('assets/images/settings/dark/02.png')}}" alt="" class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="dir-mode" data-name="dir" data-value="rtl">
                  <img src="{{asset('assets/images/settings/light/02.png')}}" alt="" class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="dir-mode" data-name="dir" data-value="rtl">
                  <span class="mt-2 "> RTL  </span>
              </div>
            </div> --}}
                    <hr class="hr-horizontal">
                    <h5 class="mt-4 mb-3">{{ __('messages.Sidebar Color') }}</h5>
                    <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                            data-value="sidebar-white">
                            <span class=""> {{ __('messages.Default') }} </span>
                        </div>
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                            data-value="sidebar-dark">
                            <span class=""> {{ __('messages.Dark') }} </span>
                        </div>
                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                            data-value="sidebar-color">
                            <span class=""> {{ __('messages.Color') }} </span>
                        </div>

                        <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                            data-value="sidebar-transparent">
                            <span class=""> {{ __('messages.Transparent') }} </span>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                    <h5 class="mt-4 mb-3">{{ __('messages.Sidebar Types') }}</h5>
                    <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/03.png') }}" alt="mini"
                                class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                                data-name="sidebar-type" data-value="sidebar-mini">
                            <img src="{{ asset('assets/images/settings/light/03.png') }}" alt="mini"
                                class="mode light-img img-fluid btn-border p-0 flex-column mb-2"
                                data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-mini">
                            <span class="mt-2">{{ __('messages.Mini') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/04.png') }}" alt="hover"
                                class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                                data-name="sidebar-type" data-value="sidebar-hover" data-extra-value="sidebar-mini">
                            <img src="{{ asset('assets/images/settings/light/04.png') }}" alt="hover"
                                class="mode light-img img-fluid btn-border p-0 flex-column mb-2"
                                data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-hover"
                                data-extra-value="sidebar-mini">
                            <span class="mt-2">{{ __('messages.Hover') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/05.png') }}" alt="boxed"
                                class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                                data-name="sidebar-type" data-value="sidebar-boxed">
                            <img src="{{ asset('assets/images/settings/light/05.png') }}" alt="boxed"
                                class="mode light-img img-fluid btn-border p-0 flex-column mb-2"
                                data-setting="sidebar" data-name="sidebar-type" data-value="sidebar-boxed">
                            <span class="mt-2">{{ __('messages.Boxed') }}</span>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                    <h5 class="mt-4 mb-3">{{ __('messages.Sidebar Active Style') }}</h5>
                    <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/06.png') }}" alt="rounded-one-side"
                                class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                                data-name="sidebar-item" data-value="navs-rounded">
                            <img src="{{ asset('assets/images/settings/light/06.png') }}" alt="rounded-one-side"
                                class="mode light-img img-fluid btn-border p-0 flex-column mb-2"
                                data-setting="sidebar" data-name="sidebar-item" data-value="navs-rounded">
                            <span class="mt-2">{{ __('messages.Rounded One Side') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/07.png') }}" alt="rounded-all"
                                class="mode dark-img img-fluid btn-border p-0 flex-column active mb-2"
                                data-setting="sidebar" data-name="sidebar-item" data-value="navs-rounded-all">
                            <img src="{{ asset('assets/images/settings/light/07.png') }}" alt="rounded-all"
                                class="mode light-img img-fluid btn-border p-0 flex-column active mb-2"
                                data-setting="sidebar" data-name="sidebar-item" data-value="navs-rounded-all">
                            <span class="mt-2">{{ __('messages.Rounded All') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/08.png') }}" alt="pill-one-side"
                                class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                                data-name="sidebar-item" data-value="navs-pill">
                            <img src="{{ asset('assets/images/settings/light/09.png') }}" alt="pill-one-side"
                                class="mode light-img img-fluid btn-border p-0 flex-column mb-2"
                                data-setting="sidebar" data-name="sidebar-item" data-value="navs-pill">
                            <span class="mt-2">{{ __('messages.Pill One Side') }}</span>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('assets/images/settings/dark/09.png') }}" alt="pill-all"
                                class="mode dark-img img-fluid btn-border p-0 flex-column" data-setting="sidebar"
                                data-name="sidebar-item" data-value="navs-pill-all">
                            <img src="{{ asset('assets/images/settings/light/08.png') }}" alt="pill-all"
                                class="mode light-img img-fluid btn-border p-0 flex-column" data-setting="sidebar"
                                data-name="sidebar-item" data-value="navs-pill-all">
                            <span class="mt-2">{{ __('messages.Pill All') }}</span>
                        </div>
                    </div>
                    <hr class="hr-horizontal">
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ __('messages.Scan QR Code') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    try {
                        $redirectURL = url('') . '/' . 'u/' . Auth::user()->id;

                        $argValues = config('advanced-config.qr_code_gradient') ?? [0, 0, 0, 0, 0, 0, 'diagonal'];
                        [$arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7] = $argValues;

                        $imgSrc = QrCode::gradient($arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7)->eye('circle')->style('round')->size(1000)->generate($redirectURL);
                        $imgSrc = base64_encode($imgSrc);
                        $imgSrc = 'data:image/svg+xml;base64,' . $imgSrc;
                        $imgType = 'svg';
                    } catch (exception $e) {
                        $imgSrc = url('/assets/linkstack/images/themes/no-preview.png');
                        $imgType = null;
                    }
                @endphp
                <div class="modal-body">
                    <div class="bd-example">
                        <img id="generatedImage" draggable="false"
                            src="@php if(isset($imgSrc)){echo $imgSrc;} @endphp" style="width:100%;height:auto;"
                            class="bd-placeholder-img img-thumbnail">
                    </div>
                </div>
                <div class="modal-footer">
                    @if ($imgType == 'png')
                        <button type="button" class="btn btn-info"
                            id="downloadButton">{{ __('messages.Download') }}</button>
                    @endif
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.Close') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Unused. Download for removed PNG QR Code generation feature. --}}
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            var downloadButton = document.getElementById("downloadButton");
            var generatedImage = document.getElementById("generatedImage");

            downloadButton.addEventListener("click", function() {
                var format = generatedImage.getAttribute("data-format") || "png";
                var downloadLink = document.createElement("a");
                downloadLink.href = generatedImage.src;
                downloadLink.download = "generated_image." + format;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            });
        });
    </script> --}}

    <!-- Settings Script -->
    <script src="{{ asset('assets/js/plugins/setting.js') }}"></script>

    <!-- mapchart Script -->
    {{-- <script src="{{ asset('assets/js/charts/vectore-chart.js') }}"></script> --}}
    <script src="{{ asset('assets/js/charts/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Sortable.min.js') }}"></script>
    <script src="{{ asset('assets/js/main-dashboard.js') }}"></script>

    @stack('sidebar-scripts')

    <script src="{{ asset('assets/js/jquery-block-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor/livewire/core.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>

    <script>
    document.addEventListener('livewire:navigated', () => {
        var collapseElement = document.getElementById("admin-section");
        if (collapseElement && window.location.href.includes('admin')) {
            collapseElement.classList.add("show");
            var toggleElement = document.getElementById("admin-toggle");
            if (toggleElement) {
                toggleElement.setAttribute("aria-expanded", "true");
            }
        }
        resizePlugins();
    }, { once: true });
    </script>

    <!-- App Script -->
    <script src="{{ asset('assets/js/hope-ui.js') }}" defer></script>

    @if($spa)
        @livewireScripts
    @endif
</body>
</html>
