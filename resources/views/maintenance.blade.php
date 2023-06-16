@if($_SERVER['QUERY_STRING'] === '')
<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  @if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.title') != '')
  <title>{{ config('advanced-config.title') }}</title>
  @else
  <title>{{ config('app.name') }}</title>
  @endif

  @if(env('CUSTOM_META_TAGS') == 'true')
  @include('layouts.meta') 
  @else
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @endif

  <!-- Custom icons font-awesome -->
  <script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('assets/external-dependencies/fontawesome.css') }}" />

  @include('layouts.fonts') 
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animate.css') }}">
  @if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
  <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
  @endif

  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animations.css') }}">
  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-dark.css') }}">
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-light.css') }}">
  @elseif (config('advanced-config.theme') == 'dark')
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-dark.css') }}">
  @elseif (config('advanced-config.theme') == 'light')
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-light.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-auto.css') }}">
  @endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('assets/linkstack/fonts/littlelink-custom.otf') }}) format("opentype")}</style>

<style>
html,
body {
  height: 100%;
  width: 100%;
}

.containerr {
  align-items: center;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 100%;
  width: 100%;
}

@media (min-width:700px) {
.row {
  display: flex;
  flex-direction: row;
  }
}
</style>

</head>
<body>

<div class="containerr" style="">
      <div class="column">
        <!-- Your Image Here -->
        @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
        <img alt="avatar" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" width="auto" height="200px">
        @else
        <div class="logo-container">
           <img src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo" style="width:200px; height:200px;">
        </div>
        @endif

        <div style="padding-bottom:5%;">
        <h1 style="font-size: 300%;"><i class="fa-solid fa-screwdriver-wrench"></i> {{__('messages.Maintenance Mode')}} <i class="fa-solid fa-screwdriver-wrench"></i></h1>
		      <h2>{{__('messages.We are performing scheduled site maintenance at this time')}}</h2>
          <h3>{{__('messages.Please check back with us later')}}</h3>
          @if(auth()->user() && auth()->user()->role == 'admin')
          <br><center><i>{{__('messages.Admin options:')}}</i></center>
          <a href="{{url('dashboard')}}">{{__('messages.Dashboard')}}</a> | <a href="{{url('?maintenance=off')}}" onclick="return confirm('{{__('messages.Warn.Disable.Maintenance')}}');">{{__('messages.Turn off')}}</a>
          @endif
        </div>

      </div>
    </div>
  </div>
</body>
</html>
@elseif($_SERVER['QUERY_STRING'] === 'maintenance=off')
@php
EnvEditor::editKey('MAINTENANCE_MODE', false);
ob_clean();
header("Location: " . url('dashboard'));
exit;
@endphp
@endif