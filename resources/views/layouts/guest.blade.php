<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

@include('layouts.analytics')

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		@if(file_exists(base_path("littlelink/images/").findFile('favicon')))
		<link rel="icon" type="image/png" href="{{ asset('littlelink/images/'.findFile('favicon')) }}">
		@else
		<link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
		@endif

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
  <!-- begin dark mode detection -->
	<script src="{{ asset('littlelink/js/js.cookie.min.js') }}"></script>
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
		@if ($color_scheme == 'dark' and config('advanced-config.theme') != 'light' and $color_scheme_override != 'light' or $color_scheme_override == 'dark' or config('advanced-config.theme') == 'dark')
		<link rel="stylesheet" href="{{ asset('css/app-dark.css') }}">
		@endif
  <!-- end dark mode detection -->
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
