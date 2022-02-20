<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Page Information
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>{{ config('app.name' )}}</title>
  <meta name="description" content="Find us online!">
  <meta name="author" content="Seth Cottle">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  @if(file_exists(base_path("littlelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">

      <div class="column" style="margin-top: 10%">
        <!-- Your Image Here -->
        @if(file_exists(base_path("littlelink/images/avatar.png" )))
        <img src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">
        @else
        <img src="https://prieber.com/social/littlelink/images/logo.svg" alt="Logo"></img>
        @endif
        <br>

        <div class="jumbotron">
          <h1 class="display-4">{{ $name }}</h1>
          <hr class="my-4">
          <p>
          {{ $data['page']->$name }}
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
