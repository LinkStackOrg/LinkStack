<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@include('layouts.analytics')

  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//fonts.bunny.net/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <style>@font-face{font-family:'ll';src:url({{ asset('content/fonts/arcanelink-custom.otf') }}) format("opentype")}</style>
  <link rel="stylesheet" href="{{ asset('content/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('content/css/animate.css') }}">
  @if(file_exists(base_path("arcanelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('content/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/png" href="{{ asset('content/images/arcanelink-logo.png') }}">
  @endif

  <!-- begin dark mode detection -->
	<script src="{{ asset('content/js/js.cookie.min.js') }}"></script>
	<script>
		// code to set the `color_scheme` cookie
		var $color_scheme = Cookies.get("color_scheme");
		function get_color_scheme() {
		return (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? "dark" : "light";
		}
		function update_color_scheme() {
		Cookies.set("color_scheme", get_color_scheme());
		}
		// read & compare cookie `color-scheme`
		if ((typeof $color_scheme === "undefined") || (get_color_scheme() != $color_scheme))
		update_color_scheme();
		// detect changes and change the cookie
		if (window.matchMedia)
		window.matchMedia("(prefers-color-scheme: dark)").addListener( update_color_scheme );
		// reloads page to apply the dark mode cookie
		window.onload = function() {
		    if(!window.location.hash && get_color_scheme() == "dark" && (get_color_scheme() != $color_scheme)) {
		        window.location = window.location + '#dark';
		        window.location.reload();
		    }
		}
	</script>
		<?php // loads dark mode CSS if dark mode detected
		   $color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false; 
			 $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
		@if ($color_scheme == 'dark' and config('advanced-config.theme') != 'light' and $color_scheme_override != 'light' or $color_scheme_override == 'dark')
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
					<link rel="stylesheet" href="{{ asset('content/css/skeleton-dark.css') }}">
		@elseif (config('advanced-config.theme') == 'dark')
					<link rel="stylesheet" href="{{ asset('content/css/skeleton-dark.css') }}">
		@elseif (config('advanced-config.theme') == 'light')
					<link rel="stylesheet" href="{{ asset('content/css/skeleton-light.css') }}">
		@else
					<link rel="stylesheet" href="{{ asset('content/css/skeleton-light.css') }}">
		@endif
  <!-- end dark mode detection -->

<style>.container-text{position:relative;width:95%;max-width:900px;margin:0 auto;box-sizing:border-box}</style>
</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container-text">
    <div class="row">

      <div class="column" style="margin-top: 10%">
        <!-- Your Image Here -->
        @if(file_exists(base_path("arcanelink/images/avatar.png" )))
        <img src="{{ asset('content/images/avatar.png') }}" srcset="{{ asset('content/images/avatar@2x.png 2x') }}" width="100px" height="100px">
        @else
        <div class="logo-container fadein">
           <img class="rotate" src="{{ asset('content/images/arcanelink-logo.png') }}" alt="Logo" style="width:150px; height:150px;">
        </div>
        @endif

        <div class="jumbotron" style="margin-top: 10%">
          <h1 class="display-4">{{ $name }}</h1>
          <hr class="my-4">
          <p>
            <?php echo $data['page']->$name; ?>
          </p>
          <p class="lead">
          </p>
        </div>

        @include('layouts.footer')

      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
