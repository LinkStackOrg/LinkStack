<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">

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
	</script>
		<?php // loads dark mode CSS if dark mode detected
		     $color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false; ?>
		@if ($color_scheme == 'dark')
					<!-- switch the two <link> Tags below to default to dark mode if cookie detection fails -->
					<link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
				@else
					<link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
					@endif
  <!-- end dark mode detection -->
</head>
<body>
  <div class="container">
    <div class="row">
    <div class="sign" style="margin-top: 30px; text-align: right;">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('studioIndex') }}" class="underline">Studio</a>
                    @else
                        <a href="{{ route('login') }}" class="underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="underline">Register</a>
                        @endif
                    @endauth
              @endif
    </div>
      <div class="column" style="margin-top: 10%">
        <!-- Your Image Here -->
        <img src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">

        <!-- Your Name -->
        <h1 class="mt-5"> {{ config('app.name') }} </h1>

        <!-- Short Bio -->
        <p class="mt-5">{{ $message->home_message }}</p>
        
<?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
        <!-- Replace # with your profile URL. Delete whatever you don't need & create your own brand styles in css/brands.css -->  
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-github button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/github.svg') }}">Github</a></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-twitter button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/twitter.svg') }}">Twitter</a></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-instagram button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/instagram.svg') }}">Instagram</a></div>
        <!--<a class="button button-pinterest" href="#"><img class="icon" src="{{ asset('littlelink/icons/pinterest.svg') }}">Pinterest</a>-->
        </br></br>

        <p>and {{ $countButton - 3 }} other button ...</p>
      
        <hr class="my-4" style="display:none">

        <p style="display:none">updated pages</p>

        <div class="updated" style="display:none">
        @foreach($updatedPages as $page)
          @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
          <a href="{{ config('app.url') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" srcset="{{ asset("img/$page->littlelink_name" . "@2x.png 2x") }}" width="50px" height="50px">
          </a>
          @else
          <a href="{{ config('app.url') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="50px" height="50px">
          </a>
          @endif
        @endforeach
        </div>

        @include('layouts.footer')

      </div>
    </div>
  </div>
</body>
</html>
