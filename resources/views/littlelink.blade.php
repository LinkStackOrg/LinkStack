<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>{{ $littlelink_name }} 🔗 {{ config('app.name') }} </title>
  <meta name="description" content="{{ $userinfo->littlelink_description }}">
  <meta name="author" content="{{ $userinfo->name }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
<!--#### BEGIN Meta Tags social media preview images  ####-->
  <!-- This shows a preview for title, description and avatar image of users profiles if shared on social media sites -->

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ config('app.url') }}/@littlelink_name"">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $userinfo->littlelink_name }}">
    <meta property="og:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(public_path("img/$littlelink_name" . ".png" )))
    <meta property="og:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta property="og:image" content="{{ asset('littlelink/images/avatar@2x.png') }}">
    @endif
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ config('app.url') }}/@littlelink_name">
    <meta property="twitter:url" content="https://prieber.com/socials/index.php/">
    <meta name="twitter:title" content="{{ $userinfo->littlelink_name }}">
    <meta name="twitter:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(public_path("img/$littlelink_name" . ".png" )))
    <meta name="twitter:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta name="twitter:image" content="{{ asset('littlelink/images/avatar@2x.png') }}">
    @endif

<!--#### END Meta Tags social media preview images  ####-->
  
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  <style>
	.container { max-width: 1080px !important; }
  	.button-title { 
  		    color: white !important;
		    background: #505050 !important;
		    height: auto !important;
		    line-height: 28px !important;
		    width: auto !important;
		    padding: 10px !important;
		    min-width: 300px !important;
  	}
  	
  	@media (max-width: 767px) {
  	}
  </style>
</head>
<body>
  <div class="container">
    <div class="row">

      <div class="column" style="margin-top: 5%">
        <!-- Your Image Here -->
          @if(file_exists(public_path("img/$littlelink_name" . ".png" )))
          <img class="rounded-avatar" src="{{ asset("img/$littlelink_name" . ".png") }}" width="100px" height="100px">
          @else
          <img class="rounded-avatar" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="100px" height="100px">
          @endif

        @foreach($information as $info)
        <!-- Your Name -->
        <h1>{{ $info->littlelink_name }}</h1>

        <!-- Short Bio -->
        <p>{{ $info->littlelink_description }}</p>
        
        @endforeach
        <!-- Buttons -->
        @foreach($links as $link)
         @php $linkName = str_replace('default ','',$link->name) @endphp
         @if($link->button_id === 0)
         <a class="button button-title button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank">
         	{{ $link->title }}</a>
          <br>
         @elseif($link->name === "custom")
         <a class="button button-{{ $link->name }} button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . $linkName }}.svg">{{ $link->title }}</a>
          <br>
         @else
         <a class="button button-{{ $link->name }} button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . $linkName }}.svg">{{ ucfirst($linkName) }}</a>
          <br>
         @endif
        @endforeach

        @include('layouts.footer')
          
      </div>
    </div>
  </div>
</body>
</html>
