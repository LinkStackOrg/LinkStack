
<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  <meta name="viewport" content="width=device-width, initial-scale=1">

@stack('updater-head')

  <title>Update</title>
  <link href="//fonts.bunny.net/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('content/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/animate.css') }}">
  <script src="https://kit.fontawesome.com/c4a5e06183.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" integrity="sha384-fZCoUih8XsaUZnNDOiLqnby1tMJ0sE7oBbNk2Xxf5x8Z4SvNQ9j83vFMa/erbVrV" crossorigin="anonymous"/>
  @if(file_exists(base_path("arcanelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('content/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/png" href="{{ asset('content/images/arcanelink-logo.png') }}">
  @endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('content/fonts/arcanelink-custom.otf') }}) format("opentype")}</style>

  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('content/css/skeleton-dark.css') }}">
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('content/css/skeleton-light.css') }}">
  @elseif (config('advanced-config.theme') == 'dark')
  <link rel="stylesheet" href="{{ asset('content/css/skeleton-dark.css') }}">
  @elseif (config('advanced-config.theme') == 'light')
  <link rel="stylesheet" href="{{ asset('content/css/skeleton-light.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('content/css/skeleton-auto.css') }}">
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
}
button:hover {
    background-color: #0065c1;
    color: #FFF;
    box-shadow: 0 10px 20px -10px rgba(0,0,0, 0.6);
}

.btn {
    color: #FFF !important;
}

</style>

</head>
<body>

@stack('updater-body')

</body>
</html>
