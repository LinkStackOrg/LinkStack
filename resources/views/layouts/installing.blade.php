
<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  <meta name="viewport" content="width=device-width, initial-scale=1">

@stack('installer-head')

  <title>{{__('messages.LinkStack setup')}}</title>
  @include('layouts.fonts') 
  <link rel="stylesheet" href="{{ asset('assets/external-dependencies/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animate.css') }}">
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

h1 {
  font-size: 30px;
  margin-bottom: -20px;
  font-weight: 700;
}

.inst-txt {
  font-size: 15px;
  margin-bottom: 50px;
  display: flex;
}

.left-txt {
  display: inline;
  text-align: left;
}
.left-txt p {
  margin-bottom: 0px !important;
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
    width: 150px;
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
}
button:hover {
    background-color: #0065c1;
    color: #FFF;
    box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);
}

.btn {
    color: #FFF !important;
    height: 62px;
}



.form-control {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
.input-group {
    position: relative;
    display: --webkit-box;
    display: --ms-flexbox;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 100%;
    z-index: 200000;
}
.input-group-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 0.375rem 1rem;
    margin-bottom: -52px;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    dark-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-top-left-radius: 0.25rem;
    border-bottom-left-radius: 0.25rem;
    z-index: 200000;
}
.input-group-prepend {
    margin-right: -1px;
    display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    z-index: 200000;
}
.glass-container{
    display: block;
    padding: 10px;
    background-color: rgba(0,0,0,.3);
    color: #fff;
    text-align: left;
    border-radius: 3px;
    cursor: default;
    padding: 25px;
}
</style>

</head>
<body>

@stack('installer-body')

</body>
</html>
