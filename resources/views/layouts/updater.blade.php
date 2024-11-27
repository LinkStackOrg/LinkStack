
<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  <meta name="viewport" content="width=device-width, initial-scale=1">

@stack('updater-head')

  <title>{{__('messages.Update LinkStack')}}</title>
  @include('layouts.fonts') 
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animate.css') }}">
  <script src="{{ asset('assets/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
  @if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
  <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
  @endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('assets/linkstack/fonts/littlelink-custom.otf') }}) format("opentype")}</style>

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

<style>

html,
body {
  height: 100%;
  width: 100%;
}

.container {
  align-items: center;
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

.logo-centered {
  /* top: 44vh; */
  font-size: 130px;
}

.logo-img{
    /* position: relative; */
    width: 250px;
    height: auto;
}

.loading {
  animation: loading 3s linear infinite;
}

@keyframes loading {
  from {
  	transform: rotate(0deg);
  }
  
  to {
  	transform: rotate(359deg);
  }
}

.generic {
  margin: auto;
  width: 2.5em;
  height: 2.5em;
  border: 0.4em solid transparent;
  border-color: #eee;
  border-top-color: #333;
  border-radius: 50%;
  animation: loadingspin 1s linear infinite;
}

@keyframes loadingspin {
	100% {
			transform: rotate(360deg)
	}
}

.loadingtxt:after {
  content: '.';
  animation: dots 1.5s steps(5, end) infinite;}

@keyframes dots {
  0%, 20% {
    color: rgba(0,0,0,0);
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  40% {
    color: white;
    text-shadow:
      .25em 0 0 rgba(0,0,0,0),
      .5em 0 0 rgba(0,0,0,0);}
  60% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 rgba(0,0,0,0);}
  80%, 100% {
    text-shadow:
      .25em 0 0 white,
      .5em 0 0 white;}}

button {
    border-style: none;
    background-color: #0085ff;
    margin: 5px;
}
button:hover {
    background-color: #0065c1;
    color: #FFF;
    box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);
}

.btn {
    color: #FFF !important;
}

.noteslink:hover {
            color: #006fd5;
            text-shadow: 0px 6px 7px rgba(23, 10, 6, 0.66);
}

.alert-box {
  padding: 10px 15px;
  margin: 10px 0;
  border-left: 5px solid;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.alert-box-error {
  background-color: #f0cccc;
  color: #a94442;
  border-color: #db5552;
}

</style>

</head>
<body>

@stack('updater-body')

</body>
</html>
