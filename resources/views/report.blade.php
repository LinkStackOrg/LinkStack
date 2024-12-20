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

if ($_SERVER['QUERY_STRING'] != '') { 

    try {

    $id = $_SERVER['QUERY_STRING'];
    $user = \App\Models\User::where('id', $id)->first();
    $name = $user->littlelink_name;
    if ($name != null)$url = url('') . '/@' . $name;

    } catch (\Exception $e) {}

}

@endphp

<body class="{{ $colorMode ?? null }}">
    <div class="container-fluid">
        <div class="align-items-center justify-content-center d-flex min-vh-100">
            <div class="col-10 col-sm-8 col-md-6 col-lg-5">
                <div class="card shadow-lg card--bg-gray card--customized align-self-center">
                    <div class="card-body">
                        <h1 class="card-title">{{ __('messages.report_violation') }}</h1>

                    @if(session('success'))
                        <div class="alert alert-left alert-success alert-dismissible fade show mb-3" role="alert">
                            <span> {{ __('messages.report_success') }}</span>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-right alert-warning alert-dismissible fade show mb-3" role="alert">
                            <span> {{ __('messages.report_error') }}</span>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                        <form action="{{ url('report') }}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$id ?? null}}">
                            <input type="hidden" name="name" value="{{$name ?? null}}">
                            <div class="mb-2 control-wrapper">
                                <div class="label-container">
                                    <label for="url" class="form-label">{{ __('messages.url_label') }}*</label>
                                </div>
                                <input type="url" class="form-control" id="url" name="url" value="{{ $url ?? null }}">
                                <div class="display-msg"></div>
                            </div>
                            <div class="mb-2 control-wrapper">
                                <div class="label-container">
                                    <label for="report-type" class="form-label">{{ __('messages.report_type_label') }}*</label>
                                </div>
                                <select id="report-type" class="form-control" name="report-type" required>
                                    <option></option>
                                    <option value="{{ __('messages.hate_speech') }}">{{ __('messages.hate_speech') }}</option>
                                    <option value="{{ __('messages.violence_threats') }}">{{ __('messages.violence_threats') }}</option>
                                    <option value="{{ __('messages.illegal_activities') }}">{{ __('messages.illegal_activities') }}</option>
                                    <option value="{{ __('messages.copyright_infringement') }}">{{ __('messages.copyright_infringement') }}</option>
                                    <option value="{{ __('messages.misinformation_fake_news') }}">{{ __('messages.misinformation_fake_news') }}</option>
                                    <option value="{{ __('messages.identity_theft') }}">{{ __('messages.identity_theft') }}</option>
                                    <option value="{{ __('messages.drug_related_content') }}">{{ __('messages.drug_related_content') }}</option>
                                    <option value="{{ __('messages.weapons_harmful_objects') }}">{{ __('messages.weapons_harmful_objects') }}</option>
                                    <option value="{{ __('messages.child_exploitation') }}">{{ __('messages.child_exploitation') }}</option>
                                    <option value="{{ __('messages.fraud_scams') }}">{{ __('messages.fraud_scams') }}</option>
                                    <option value="{{ __('messages.privacy_violation') }}">{{ __('messages.privacy_violation') }}</option>
                                    <option value="{{ __('messages.impersonation') }}">{{ __('messages.impersonation') }}</option>
                                    <option value="{{ __('messages.other_specify') }}">{{ __('messages.other_specify') }}</option>                                    
                                </select>
                                <div class="display-msg"></div>
                            </div>
                            <div class="mb-4 control-wrapper">
                                <div class="label-container">
                                    <label for="message" class="form-label">{{ __('messages.additional_comments_label') }}</label>
                                </div>
                                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                <div class="display-msg"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('messages.submit_button') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
</html>