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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/solid.css" integrity="sha384-0BumEd2qDQ2SCps2Pnnhegpr+si0PveDhbdhKgLYwY9x611h8s22Zh8td+W7jeys" crossorigin="anonymous"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/fontawesome.css" integrity="sha384-X8QTME3FCg1DLb58++lPvsjbQoCT9bp3MsUU3grbIny/3ZwUJkRNO8NPW6zqzuW9" crossorigin="anonymous"/>

  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  @if(file_exists(base_path("littlelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif

  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animations.css') }}">
  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  @elseif (config('advanced-config.theme') == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  @elseif (config('advanced-config.theme') == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-auto.css') }}">
  @endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('littlelink/fonts/littlelink-custom.otf') }}) format("opentype")}</style>

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
        @if(file_exists(base_path("littlelink/images/avatar.png" )))
        <img alt="avatar" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="200px" height="200px">
        @else
        <div class="logo-container">
           <img src="{{ asset('littlelink/images/logo.svg') }}" alt="Logo" style="width:200px; height:200px;">
        </div>
        @endif

        <div style="padding-bottom:5%;">
        <h1 style="font-size: 300%;"><i class="fa-solid fa-screwdriver-wrench"></i> Maintenance Mode <i class="fa-solid fa-screwdriver-wrench"></i></h1>
		      <h2>We are performing scheduled site maintenance at this time.</h2>
          <h3>Please check back with us later.</h3>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
