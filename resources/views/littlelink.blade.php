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
    <meta property="og:url" content="{{ url('') }}/@littlelink_name">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $userinfo->littlelink_name }}">
    <meta property="og:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
    <meta property="og:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta property="og:image" content="{{ asset('littlelink/images/logo.svg') }}">
    @endif
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url('') }}/@littlelink_name">
    <meta property="twitter:url" content="{{ url('') }}/@littlelink_name">
    <meta name="twitter:title" content="{{ $userinfo->littlelink_name }}">
    <meta name="twitter:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
    <meta name="twitter:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta name="twitter:image" content="{{ asset('littlelink/images/logo.svg') }}">
    @endif

<!--#### END Meta Tags social media preview images  ####-->
  
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/hover-min.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/share.button.css') }}">
  @if(file_exists(base_path("littlelink/images/avatar.png" )))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/avatar.png') }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif
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

<?php ////begin share button//// ?>
<?php 
//Get browser type
$arr_browsers = ["Opera", "Edg", "Chrome", "Safari", "Firefox", "MSIE", "Trident"];
 
$agent = $_SERVER['HTTP_USER_AGENT'];
 
$user_browser = '';
foreach ($arr_browsers as $browser) {
    if (strpos($agent, $browser) !== false) {
        $user_browser = $browser;
        break;
    }   
}
  
switch ($user_browser) {
    case 'MSIE':
        $user_browser = 'Internet Explorer';
        break;
  
    case 'Trident':
        $user_browser = 'Internet Explorer';
        break;
  
    case 'Edg':
        $user_browser = 'Microsoft Edge';
        break;
}

function get_operating_system() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $operating_system = 'NULL';

    //get operating-system type
        if (preg_match('/iphone/i', $u_agent)) {
        $operating_system = 'mobile';
    } elseif (preg_match('/ipod/i', $u_agent)) {
        $operating_system = 'mobile';
    } elseif (preg_match('/ipad/i', $u_agent)) {
        $operating_system = 'mobile';
    } elseif (preg_match('/android/i', $u_agent)) {
        $operating_system = 'mobile';
    } elseif (preg_match('/blackberry/i', $u_agent)) {
        $operating_system = 'mobile';
    } elseif (preg_match('/webos/i', $u_agent)) {
        $operating_system = 'mobile';
    }
    
    return $operating_system;
}
?>

@if($user_browser === 'Chrome' or get_operating_system() == 'mobile')
<script  src="{{ asset('littlelink/js/jquery.min.js') }}"></script>
<div align="right" class="sharediv"><div class="button-entrance"><a class="sharebutton hvr-grow hvr-icon-wobble-vertical" id='share-share-button'><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}share.svg">Share</a></div></div>
<span class="copy-icon" role="button">
</span>
@else
<span class="copy-icon" role="button">
<div align="right" class="sharediv"><div class="button-entrance"><a class="sharebutton hvr-grow hvr-icon-wobble-vertical"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}share.svg">Share</a></div></div>
</span>
@endif
<div class="toastdiv">
<span class="toastbox" role="alert"></span>
<script  src="{{ asset('littlelink/js/share.button.js') }}"></script>
</div>
<?php ////end share button//// ?>

  <div class="container">
    <div class="row">
      <div class="column" style="margin-top: 5%">
        <!-- Your Image Here -->
          @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
          <img class="rounded-avatar fadein" src="{{ asset("img/$littlelink_name" . ".png") }}" width="100px" height="100px">
          @elseif(file_exists(base_path("littlelink/images/avatar.png" )))
          <img class="rounded-avatar fadein" src="{{ asset('littlelink/images/avatar.png') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="100px" height="100px">
          @else
          <img class="rounded-avatar fadein" src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="100px" height="100px">
          @endif

        @foreach($information as $info)
        <!-- Your Name -->
        <h1 class="fadein">{{ $info->littlelink_name }}</h1>

        <!-- Short Bio -->
        <p class="fadein">{{ $info->littlelink_description }}</p>
        
        @endforeach		
        <!-- Buttons -->
<?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
        @foreach($links as $link)
         @php $linkName = str_replace('default ','',$link->name) @endphp
         @if($link->button_id === 0)
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-title button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank">
         	{{ $link->title }}</a></div>
         @elseif($link->name === "custom")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . $linkName }}.svg">{{ $link->title }}</a></div>
         @elseif($link->name === "buy me a coffee")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-coffee button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/')}}coffee.svg">Buy me a Coffee</a></div>
         @elseif($link->name === "custom_website")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-custom_website button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="http://www.google.com/s2/favicons?domain={{$link->link}}">{{ $link->title }}</a></div>
         @else
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button hvr-grow hvr-icon-wobble-vertical" href="{{ route('clickNumber') . '/' . $link->id . '/' . $link->link}}" target="_blank"><img class="icon hvr-icon" src="{{ asset('\/littlelink/icons\/') . $linkName }}.svg">{{ ucfirst($linkName) }}</a></div>
         @endif
        @endforeach

        @include('layouts.footer')
          
      </div>
    </div>
  </div>
</body>
</html>
