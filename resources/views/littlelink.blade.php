<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Page Information
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>{{ $littlelink_name }} 🔗 {{ config('app.name') }} </title>
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
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">

      <div class="column" style="margin-top: 10%">
        <!-- Your Image Here -->
          @if(file_exists(public_path("img/$littlelink_name" . ".png" )))
          <img src="{{ asset("img/$littlelink_name" . ".png") }}" srcset="{{ asset("img/$littlelink_name" . "@2x.png 2x") }}" width="100px" height="100px">
          @else
          <img src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}">
          @endif

        @foreach($information as $info)
        <!-- Your Name -->
        <h1>{{ $info->littlelink_name }}</h1>

        <!-- Short Bio -->
        <p>{{ $info->littlelink_description }}</p>
        
        @endforeach
        <!-- Buttons -->
        @foreach($links as $link)
        <a class="button button-{{ $link->name }}" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon" src="{{ asset('\/littlelink/icons\/') . $link->name }}.svg">{{ ucfirst($link->name) }}</a>
          <br>
        @endforeach

        @include('layouts.footer')
          
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
