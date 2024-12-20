<!doctype html>
@include('layouts.lang')
  <head>
    <meta charset="utf-8">
    @php $GLOBALS['themeName'] = config('advanced-config.home_theme'); @endphp
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      @if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.title') != '')
      <title>{{ config('advanced-config.title') }}</title>
      @else
      <title>{{ config('app.name') }}</title>
      @endif

      @php include app_path("View/Includes/DarkMode.php"); @endphp
      
<!--#### BEGIN Meta Tags social media preview images  ####-->
  <!-- This shows a preview for title, description and avatar image of users profiles if shared on social media sites -->

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{env('APP_NAME')}}">
    <meta property="og:description" content='@if($message->home_message == "default"){!!strip_tags(__('messages.HOME.MESSAGE'))!!}@else{!!$message->home_message!!}@endif'>
    @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
    <meta property="og:image" content="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}">
    @else
    <meta property="og:image" content="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url('') }}">
    <meta property="twitter:url" content="{{ url('') }}">
    <meta name="twitter:title" content="{{env('APP_NAME')}}">
    <meta name="twitter:description" content='@if($message->home_message == "default"){!!strip_tags(__('messages.HOME.MESSAGE'))!!}@else{!!$message->home_message!!}@endif'>
    @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
    <meta name="twitter:image" content="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}">
    @else
    <meta name="twitter:image" content="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif

<!--#### END Meta Tags social media preview images  ####-->

      <!-- Favicon -->
      @if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
      <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
      @else
      <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
      @endif

      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="{{asset('assets/css/core/libs.min.css')}}" />
      
      <!-- Aos Animation Css -->
      <link rel="stylesheet" href="{{asset('assets/vendor/aos/dist/aos.css')}}" />
      
      @include('layouts.fonts')
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="{{asset('assets/css/hope-ui.min.css?v=2.0.0')}}" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="{{asset('assets/css/custom.min.css?v=2.0.0')}}" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="{{asset('assets/css/dark.min.css')}}" />
      
      <!-- Customizer Css -->
            @if(file_exists(base_path("assets/dashboard-themes/dashboard.css")))
      <link rel="stylesheet" href="{{asset('assets/dashboard-themes/dashboard.css')}}" />
      @else
      <link rel="stylesheet" href="{{asset('assets/css/customizer.min.css')}}" />
      @endif
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="{{asset('assets/css/rtl.min.css')}}" />
      
      
  </head>

  @php
  $pages = DB::table('pages')->get();
  foreach($pages as $page){}
  @endphp

  <body class="{{ $colorMode ?? null }}" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar fixed-top">
          <div class="container-fluid navbar-inner">
            <a href="{{ route('panelIndex') }}" class="navbar-brand">
                
                <!--Logo start-->
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
                    <img class="img logo" type="image/svg+xml" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                </div>
                <div class="logo-mini">
                  <img class="img logo" type="image/svg+xml" src="{{ asset('assets/linkstack/images/logo.svg') }}" width="30px" height="30px">
                </div>
                  @endif
                  </div>
                <!--logo End-->
                
                
                <h4 class="logo-title">{{env('APP_NAME')}}</h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="mt-2 navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                @if (Route::has('login'))
                @auth
                <li class="me-0 me-xl-2">
                  <a class="btn btn-primary btn-sm d-flex gap-2 align-items-center" aria-current="page" href="{{ url('dashboard') }}">
                    {{__('messages.Dashboard')}}
                  </a>
                </li>
            @else
                @if (Route::has('login'))
                <li class="me-0 me-xl-2">
                  <a class="btn btn-primary btn-sm d-flex gap-2 align-items-center" aria-current="page" href="{{ route('login') }}">
                    {{__('messages.Log in')}}
                  </a>
                </li>
                @endif
            
                @if ((env('ALLOW_REGISTRATION')) and !config('linkstack.single_user_mode'))
                <li class="me-0 me-xl-2">
                  <a class="btn btn-secondary btn-sm d-flex gap-2 align-items-center" aria-current="page" href="{{ route('register') }}">
                    {{__('messages.Register')}}
                  </a>
                </li>
                @endif
            @endauth        
                  @endif
              </ul>
            </div>
          </div>
        </nav>
        <!--Nav End-->

    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
    <div class="wrapper d-flex">
      <section class="login-content">
        <div class="row m-0 align-items-center bg-white vh-100 vw-100">
          <div class="col-md-6 p-0">
            <div class="card card-transparent auth-card shadow-none d-flex mb-0">
              <div class="card-body justify-content-center text-center">
    
                @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
                <img alt="avatar" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" width="auto" height="128px">
                @else
                <div class="logo-container fadein">
                  <img src="{{ asset('assets/linkstack/images/logo-animated.svg') }}" alt="Logo" style="width:150px; height:150px;">
                </div>
                @endif
    
                <h1 class="h1 fw-bold mb-4 pt-4">{{ config('app.name') }}</h1>

                <div class="lead">
                  @if($message->home_message == "default")
                    {!!__('messages.HOME.MESSAGE')!!}
                  @else
                    {!!$message->home_message!!}
                  @endif
                </div>
    
                <div class="d-flex justify-content-center align-items-center pt-4">
                  @if (Route::has('login'))
                  @auth
                  <a class="btn btn-primary me-3" href="{{ url('dashboard') }}">{{__('messages.Dashboard')}}</a>
              @else
                  @if (Route::has('login'))
                  <a class="btn btn-primary me-3" href="{{ route('login') }}">{{__('messages.Log in')}}</a>
                  @endif
              
                  @if ((env('ALLOW_REGISTRATION')) and !config('linkstack.single_user_mode'))
                  <a class="btn btn-secondary me-3" href="{{ route('register') }}">{{__('messages.Register')}}</a>
                  @endif
              @endauth
                    @endif
                </div>

              </div>
            </div>
          </div>
          <div class="col-md-6 d-md-block d-none bg-light p-0 mt-n1 vh-100 overflow-hidden">
            <div class="d-flex align-items-center h-100">
              <div class="card-body justify-content-center text-center">
                <style>.iframe-container{position:relative;width:100%;max-width:370px;height:650px;}.iframe-container iframe{position:absolute;top:0;left:0;width:100%;height:100%;border-radius:30px;border:16px solid black}@media only screen and (max-width:767px){.iframe-container{max-width:375px;margin:0 auto 20px}.iframe-container:after{content:"";display:block;padding-bottom:15px}}</style>
<center><div class="iframe-container"><iframe src="{{url('/demo-page')}}"></iframe></div></center>
              </div>
            </div>
          </div>
      </section>
    </div>    
    
          <!-- Footer Section Start -->
          <footer class="footer fixed-bottom">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                  @if(env('DISPLAY_FOOTER') === true)
                    @if(env('DISPLAY_FOOTER_HOME') === true)<li class="list-inline-item"><a class="list-inline-item" href="@if(str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) === "" ){{ url('') }}@else{{ str_replace('"', "", EnvEditor::getKey('HOME_FOOTER_LINK')) }}@endif">{{footer('Home')}}</a></li>@endif
                    @if(env('DISPLAY_FOOTER_TERMS') === true)<li class="list-inline-item"><a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Terms')) }}">{{footer('Terms')}}</a></li>@endif
                    @if(env('DISPLAY_FOOTER_PRIVACY') === true)<li class="list-inline-item"><a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Privacy')) }}">{{footer('Privacy')}}</a></li>@endif
                    @if(env('DISPLAY_FOOTER_CONTACT') === true)<li class="list-inline-item"><a class="list-inline-item" href="{{ url('') }}/pages/{{ strtolower(footer('Contact')) }}">{{footer('Contact')}}</a></li>@endif
                  @endif
                </ul>
                <div class="right-panel">
                  {{__('messages.Copyright')}} &copy; @php echo date('Y'); @endphp {{ config('app.name') }}
                  @if(env('DISPLAY_CREDIT_FOOTER') === true)
                    <span class="">
                      - {{__('messages.Made with')}} 
                        <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
                        </svg>
                    </span> {{__('messages.by')}} <a href="https://linkstack.org/" target="_blank">LinkStack</a>.
                  @endif
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

    <!-- Library Bundle Script -->
    <script src="{{asset('assets/js/core/libs.min.js')}}"></script>
    
    <!-- External Library Bundle Script -->
    <script src="{{asset('assets/js/core/external.min.js')}}"></script>
    
    <!-- Widgetchart Script -->
    <script src="{{asset('assets/js/charts/widgetcharts.js')}}"></script>
    
    <!-- mapchart Script -->
    <script src="{{asset('assets/js/charts/vectore-chart.js')}}"></script>
    <script src="{{asset('assets/js/charts/dashboard.js')}}" ></script>
    
    <!-- fslightbox Script -->
    <script src="{{asset('assets/js/plugins/fslightbox.js')}}"></script>
    
    <!-- Settings Script -->
    <script src="{{asset('assets/js/plugins/setting.js')}}"></script>
    
    <!-- Slider-tab Script -->
    <script src="{{asset('assets/js/plugins/slider-tabs.js')}}"></script>
    
    <!-- Form Wizard Script -->
    <script src="{{asset('assets/js/plugins/form-wizard.js')}}"></script>
    
    <!-- AOS Animation Plugin-->
    <script src="{{asset('assets/vendor/aos/dist/aos.js')}}"></script>
    
    <!-- App Script -->
    <script src="{{asset('assets/js/hope-ui.js')}}" defer></script>
    
    <!-- Flatpickr Script -->
    <script src="{{asset('assets/vendor/flatpickr/dist/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/flatpickr.js')}}" defer></script>
    
    <script src="{{asset('assets/js/plugins/prism.mini.js')}}"></script>
    
  </body>
</html>