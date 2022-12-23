<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

@foreach($information as $info) @php $GLOBALS['themeName'] = $info->theme; @endphp @endforeach

<?php
// Theme Config
function theme($key){
$key = trim($key);
$file = base_path('themes/' . $GLOBALS['themeName'] . '/config.php');
  if (file_exists($file)) {
    $config = include $file;
  if (isset($config[$key])) {
    return $config[$key];
}}
return null;}

// Theme Custom Asset
function themeAsset($path){
$path = url('themes/' . $GLOBALS['themeName'] . '/extra/custom-assets/' . $path);
return $path;}
?>

@if(theme('enable_custom_code') == "true" and theme('enable_custom_head') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-head')@endif

@include('layouts.analytics')

  @if(config('advanced-config.littlelink_title') != '' and env('HOME_URL') === '')
  <title>{{ $userinfo->name }} {{ config('advanced-config.littlelink_title') }}</title>
  @elseif(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.title') != '')
  <title>{{ config('advanced-config.title') }}</title>
  @elseif(env('HOME_URL') != '')
  <title>{{ $userinfo->name }}</title>
  @else
  <title>{{ $userinfo->name }} 🔗 {{ config('app.name') }} </title>
  @endif

@if(env('CUSTOM_META_TAGS') == 'true')
  @include('layouts.meta') 
@else
  <meta name="description" content="{{ $userinfo->littlelink_description }}">
  <meta name="author" content="{{ $userinfo->name }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
@endif
  
<!--#### BEGIN Meta Tags social media preview images  ####-->
  <!-- This shows a preview for title, description and avatar image of users profiles if shared on social media sites -->

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $userinfo->name }}">
    <meta property="og:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
    <meta property="og:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta property="og:image" content="{{ asset('littlelink/images/logo.svg') }}">
    @endif
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta property="twitter:url" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta name="twitter:title" content="{{ $userinfo->littlelink_name }}">
    <meta name="twitter:description" content="{{ $userinfo->littlelink_description }}">
    @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
    <meta name="twitter:image" content="{{ asset("img/$littlelink_name" . ".png") }}">
    @else
    <meta name="twitter:image" content="{{ asset('littlelink/images/logo.svg') }}">
    @endif

<!--#### END Meta Tags social media preview images  ####-->

  <!-- Custom icons font-awesome -->
  <script src="{{ asset('studio/external-dependencies/fontawesome.js') }}" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('studio/external-dependencies/fontawesome.css') }}" />

  @include('layouts.fonts') 
  <link rel="stylesheet" href="{{ asset('littlelink/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animate.css') }}">
  @if(file_exists(base_path("littlelink/images/").findFile('favicon')))
  <link rel="icon" type="image/png" href="{{ asset('littlelink/images/'.findFile('favicon')) }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('littlelink/images/logo.svg') }}">
  @endif

@foreach($information as $info)
@if($info->theme != '' and $info->theme != 'default')

  <!-- LittleLink Custom Theme: "{{$info->theme}}" -->

  <!-- Theme details: -->
  <meta name="designer" href="{{ url('') . "/theme/@" . $littlelink_name}}" content="{{ url('') . "/theme/@" . $littlelink_name}}">

  <link rel="stylesheet" href="themes/{{$info->theme}}/share.button.css">
  @if(theme('use_default_buttons') == "true")
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  @else
  <link rel="stylesheet" href="themes/{{$info->theme}}/brands.css">
  @endif
  <link rel="stylesheet" href="themes/{{$info->theme}}/skeleton-auto.css">
@if(file_exists(base_path('themes/' . $info->theme . '/animations.css')))
  <link rel="stylesheet" href="<?php echo asset('themes/' . $info->theme . '/animations.css') ?>">
@else
  <link rel="stylesheet" href="{{ asset('littlelink/css/animations.css') }}">
@endif

@else
  <?php // override dark/light mode if override cookie is set
  $color_scheme_override = isset($_COOKIE["color_scheme_override"]) ? $_COOKIE["color_scheme_override"] : false; ?>
  <link rel="stylesheet" href="{{ asset('littlelink/css/share.button.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/animations.css') }}">
  <link rel="stylesheet" href="{{ asset('littlelink/css/brands.css') }}">
  @if ($color_scheme_override == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  <style>.social-icon{color:#fff;}</style>
  @elseif ($color_scheme_override == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <style>.social-icon{color:#222;}</style>
  @elseif (config('advanced-config.theme') == 'dark')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-dark.css') }}">
  <style>.social-icon{color:#fff;}</style>
  @elseif (config('advanced-config.theme') == 'light')
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-light.css') }}">
  <style>.social-icon{color:#222;}</style>
  @else
  <link rel="stylesheet" href="{{ asset('littlelink/css/skeleton-auto.css') }}">
  @endif
@endif
<style>.container{word-break: break-word;}</style>
</head>
<body>

@if(theme('enable_custom_code') == "true" and theme('enable_custom_body') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-body')@endif

@if($info->theme != '' and $info->theme != 'default')
    <!-- Enables parallax background animations -->
    <div class="background-container">
    <section class="parallax-background">
      <div id="object1" class="object1"></div>
      <div id="object2" class="object2"></div>
      <div id="object3" class="object3"></div>
      <div id="object4" class="object4"></div>
      <div id="object5" class="object5"></div>
      <div id="object6" class="object6"></div>
      <div id="object7" class="object7"></div>
      <div id="object8" class="object8"></div>
      <div id="object9" class="object9"></div>
      <div id="object10" class="object10"></div>
      <div id="object11" class="object11"></div>
      <div id="object12" class="object12"></div>
    </section>
    </div>
    <!-- End of parallax background animations -->
@endif

@include('components.favicon')
@include('components.favicon-extension')

<?php ////begin share button//// ?>

@if(config('advanced-config.display_share_button') != '')

   @if(config('advanced-config.display_share_button') == 'false')
   <?php $ShowShrBtn = 'false'; ?>
   @elseif(config('advanced-config.display_share_button') == 'user')
       @if($littlelink_names = Auth::user()->littlelink_name)
       <?php $ShowShrBtn = 'true'; ?>
       @else
       <?php $ShowShrBtn = 'false'; ?>
       @endif
   @else
   <?php $ShowShrBtn = 'true'; ?>
   @endif

@else
<?php $ShowShrBtn = 'true'; ?>
@endif

@if($ShowShrBtn == 'true')
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
<script src="{{ asset('littlelink/js/jquery.min.js') }}"></script>
<div align="right" class="sharediv"><div><span class="sharebutton button-hover icon-hover" id='share-share-button'><i style="color: black;" class="fa-solid fa-share sharebutton-img share-icon hvr-icon"></i><span class="sharebutton-mb">Share</span></span></div></div>
<span class="copy-icon" role="button">
</span>
@else
<span class="copy-icon" role="button">
<div onclick="alert('URL has been copied to your clipboard!')" align="right" class="sharediv"><div><a class="sharebutton button-hover icon-hover"><i style="color: black;" class="fa-solid fa-share sharebutton-img share-icon hvr-icon"></i><span class="sharebutton-mb">Share</span></a></div></div>
</span>
@endif
<script  src="{{ asset('littlelink/js/share.button.js') }}"></script>

@endif
<?php ////end share button//// ?>

  <div class="container">
    <div class="row">
      <div class="column" style="margin-top: 5%">
        <!-- Your Image Here -->
          @if(file_exists(base_path("img/$littlelink_name" . ".png" )))
          <img alt="avatar" class="rounded-avatar fadein" src="{{ asset("img/$littlelink_name" . ".png") }}" width="128px" height="128px" style="object-fit: cover;">
          @elseif(file_exists(base_path("littlelink/images/").findFile('avatar')))
          <img alt="avatar" class="rounded-avatar fadein" src="{{ asset('littlelink/images/'.findFile('avatar')) }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @else
          <img alt="avatar" class="rounded-avatar fadein" src="{{ asset('littlelink/images/logo.svg') }}" srcset="{{ asset('littlelink/images/avatar@2x.png 2x') }}" width="128px" height="128px" style="object-fit: cover;">
          @endif

        <!-- Your Name -->
        <h1 class="fadein">{{ $info->name }}</h1>

        <!-- Short Bio -->
        <div class="fadein"><center><p style="width:50%;min-width:300px;" class="fadein">@if(env('ALLOW_USER_HTML') === true){!! $info->littlelink_description !!}@else{{ $info->littlelink_description }}@endif</p></center></div>
        
        <!-- Icons -->
        @php $icons = DB::table('links')->where('user_id', $userinfo->id)->where('button_id', 94)->get(); @endphp
        <div class="row fadein social-icon-div">
        @foreach($icons as $icon)
        <a class="social-hover social-link" href="{{ route('clickNumber') . '/' . $icon->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif><i class="social-icon fa-brands fa-{{$icon->title}}"></i></a>
        @endforeach
        </div>


        @endforeach		
        <!-- Buttons -->
<?php function strp($urlStrp){return str_replace(array('http://', 'https://'), '', $urlStrp);} ?>
<?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
        @foreach($links as $link)
         @php $linkName = str_replace('default ','',$link->name) @endphp
         @if($link->name === "icon")
         @elseif($link->button_id === 0)
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-title button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif >{{ $link->title }}</a></div>
         @elseif($link->name === "phone")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-default button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ $link->link }}"><img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/phone{{theme('custom_icon_extension')}} @else{{ asset('\/littlelink/icons\/')}}phone.svg @endif"></i>{{ $link->title }}</a></div>
         @elseif($link->name === "custom" and $link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false" and $link->name === "custom"))
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
         @elseif($link->name === "custom" and $link->custom_css != "")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
         @elseif($link->name === "buy me a coffee")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-coffee button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/coffee{{theme('custom_icon_extension')}} @else{{ asset('\/littlelink/icons\/')}}coffee.svg @endif">Buy me a Coffee</a></div>
         @elseif($link->name === "mastodon")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button button-hover icon-hover" rel="me noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/{{$linkName}}{{theme('custom_icon_extension')}} @else{{ asset('\/littlelink/icons\/') . $linkName }}.svg @endif">{{ $link->title }}</a></div>
         @elseif($link->name === "custom_website"and $link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false" and $link->name === "custom"))
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-custom_website button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("studio/favicon/icons/").localIcon($link->id))){{url('studio/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif">{{ $link->title }}</a></div>
         @elseif($link->name === "custom_website" and $link->custom_css != "")
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("studio/favicon/icons/").localIcon($link->id))){{url('studio/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif">{{ $link->title }}</a></div>
         @elseif($link->name === "space")
         <?php 
          if (is_numeric($link->title) and $link->title < 10)
          echo str_repeat("<br>",$link->title);
          elseif (is_numeric($link->title) and $link->title >= 10)
          echo str_repeat("<br>",10);
          else
          echo "<br><br><br>"
          ?>
         @elseif($link->name === "heading")
         <div class="fadein"><h2>{{ $link->title }}</h2></div>
         @elseif($link->name === "text")
         <div class="fadein"><span style="">@if(env('ALLOW_USER_HTML') === true){!! $link->title !!}@else{{ $link->title }}@endif</span></div>
         @else
         <?php include base_path('config/button-names.php'); $newLinkName = $linkName; $isNewName = "false"; foreach($buttonNames as $key => $value) { if($newLinkName == $key) { $newLinkName = $value; $isNewName = "true"; } } ?>
         <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ route('clickNumber') . '/' . $link->id }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/{{$linkName}}{{theme('custom_icon_extension')}} @else{{ asset('\/littlelink/icons\/') . $linkName }}.svg @endif">@if($isNewName == "true"){{ $newLinkName }}@else{{ ucfirst($newLinkName) }}@endif</a></div>
         @endif
        @endforeach

        @include('layouts.footer')
          
      </div>
    </div>
  </div>

@if(theme('enable_custom_code') == "true" and theme('enable_custom_body_end') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-body-end')@endif

</body>
</html>
