<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name') }}</title>
  <?php $cleaner_input = strip_tags($message->home_message); ?>
  <meta name="description" content="{{ $cleaner_input }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  @if(file_exists(base_path("littlelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif

                                                        {{-- custom font for logo text --}}
  <style>@font-face{font-family:'ll';src:url({{ asset('littlelink/fonts/littlelink-custom.otf') }}) format("opentype")}</style>

  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-auto.css') }}">
  @endif
</head>
<body>

<?php
$pages = DB::table('pages')->get();
foreach($pages as $page)
{
	//Gets value from database
}
?>

  <div class="container">
    <div class="row">
    <div class="sign" style="margin-top: 30px; text-align: right;">
            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('studioIndex') }}" class="underline spacing">Studio</a>
                    @else
                        <a href="{{ route('login') }}" class="underline spacing">Log in</a>

                        @if (Route::has('register') and $page->register == 'true')
                            <a href="{{ route('register') }}" class="underline spacing">Register</a>
                        @elseif (env('REGISTER_OVERRIDE') === true)
                            <a href="{{ route('register') }}" class="underline spacing">Register</a>
                        @endif
                    @endauth
              @endif
    </div>
      <div class="column" style="margin-top: 15%">
        <!-- Your Image Here -->
        @if(file_exists(base_path("littlelink/images/avatar.png" )))
        <img alt="avatar" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px">
        @else
        <div class="logo-container fadein">
           <img class="rotate" src="{{ asset('littlelink/images/just-gear.svg') }}" alt="Logo" style="width:150px; height:150px;">
           <div class="logo-centered">l</div>
        </div>
        @endif

        <!-- Your Name -->
        <h1 class="mt-5 fadein"> {{ config('app.name') }} </h1>

        <!-- Short Bio -->
        <div class="mt-5 fadein">
		      <?php echo $message->home_message; ?>
        </div>
        
        <?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-github button hvr-grow hvr-icon-wobble-vertical"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/github.svg') }}">Github</div></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-twitter button hvr-grow hvr-icon-wobble-vertical"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/twitter.svg') }}">Twitter</div></div>
        <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-instagram button hvr-grow hvr-icon-wobble-vertical"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('littlelink/icons/instagram.svg') }}">Instagram</div></div>
        </br></br>

        <p>and {{ $countButton - 3 }} other buttons ...</p>
      
        <hr class="my-4" style="display:none">

        <p style="display:none">updated pages</p>

        <div class="updated" style="display:none">
        @foreach($updatedPages as $page)
          @if(file_exists(base_path("img/$page->littlelink_name" . ".png" )))
          <a href="{{ url('') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset("img/$page->littlelink_name" . ".png") }}" srcset="{{ asset("img/$page->littlelink_name" . "@2x.png 2x") }}" width="50px" height="50px">
          </a>
          @else
          <a href="{{ url('') }}/@<?= $page->littlelink_name ?>" target="_blank">
          <img src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="50px" height="50px">
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
