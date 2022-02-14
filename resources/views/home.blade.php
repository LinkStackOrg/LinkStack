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
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
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
        

        <!-- Replace # with your profile URL. Delete whatever you don't need & create your own brand styles in css/brands.css -->  

        <a class="button button-github button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/github.svg') }}">Github</a>
        <a class="button button-twitter button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/twitter.svg') }}">Twitter</a>
        <a class="button button-instagram button hvr-grow hvr-icon-wobble-vertical" href="#"><img class="icon hvr-icon" src="{{ asset('littlelink/icons/instagram.svg') }}">Instagram</a>
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
