<?php use App\Models\UserData; ?>

<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

  @php $GLOBALS['themeName'] = config('advanced-config.home_theme'); @endphp
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

  <!-- Custom icons font-awesome -->
  <script>{!! file_get_contents(base_path("assets/external-dependencies/fontawesome.js")) !!}</script>
  <style>{!! str_replace('../', 'studio/', file_get_contents(base_path("assets/external-dependencies/fontawesome.css"))) !!}</style>

  @include('layouts.fonts') 

  @if(theme('enable_custom_code') == "true" and theme('enable_custom_head') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-head')@endif

  @if($GLOBALS['themeName'] != '' and $GLOBALS['themeName'] != 'default')
  <link rel="stylesheet" href="themes/{{$GLOBALS['themeName']}}/share.button.css">
  @if(theme('use_default_buttons') == "true")
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  @else
  <link rel="stylesheet" href="themes/{{$GLOBALS['themeName']}}/brands.css">
  @endif
  <link rel="stylesheet" href="themes/{{$GLOBALS['themeName']}}/skeleton-auto.css">
@if(file_exists(base_path('themes/' . $GLOBALS['themeName'] . '/animations.css')))
  <link rel="stylesheet" href="<?php echo asset('themes/' . $GLOBALS['themeName'] . '/animations.css') ?>">
@else
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animations.css') }}">
@endif

@else
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/share.button.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/animations.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/skeleton-auto.css') }}">
@endif
<style>.container{word-break: break-word;}</style>

  <meta name="robots" content="noindex, follow">

<style>.container{word-break: break-word;}</style>
</head>
<body>

@if(theme('enable_custom_code') == "true" and theme('enable_custom_body') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-body')@endif

@if($GLOBALS['themeName'] != '' and $GLOBALS['themeName'] != 'default')
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

  <div class="container">
    <div class="row">
      <div class="column" style="margin-top: 15%">

        @if(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
        <img alt="avatar" src="{{ asset('assets/linkstack/images/'.findFile('avatar')) }}" width="auto" height="128px">
        @else
        <div class="logo-container fadein">
          <img src="{{ asset('assets/linkstack/images/logo.svg') }}" alt="Logo" style="width:150px; height:150px;">
        </div>
        @endif

        <h1 class="fadein">{{ config('app.name') }}</h1>


        <style>.description-parent * {margin-bottom: 1em;}.description-parent {padding-bottom: 30px;}</style>
        <center><div class="fadein description-parent"><p class="fadein">{{__('messages.Example page')}}</p></div></center>
        
        {{-- <!-- Icons -->
        @php $icons = DB::table('links')->where('user_id', $userinfo->id)->where('button_id', 94)->get(); @endphp
        <div class="row fadein social-icon-div">
        @foreach($icons as $icon)
        <a class="social-hover social-link" href="{{ route('clickNumber') . '/' . $icon->id. "?" . $icon->link}}" title="{{ucfirst($icon->title)}}" aria-label="{{ucfirst($icon->title)}}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif><i class="social-icon fa-brands fa-{{$icon->title}}"></i></a>
        @endforeach
        </div> --}}

        <!-- Buttons -->
        <?php function strp($urlStrp){return str_replace(array('http://', 'https://'), '', $urlStrp);} ?>
        <?php $initial=1; // <-- Effectively sets the initial loading time of the buttons. This value should be left at 1. ?>
        @if(config('advanced-config.use_custom_buttons') == 'true')
                <?php $array = config('advanced-config.buttons'); ?>
                @foreach($array as $button)
                 @php $linkName = str_replace('default ','',$button['button']) @endphp
                 @if($button['button'] === "custom" and ($button['custom_css'] === "" or $button['custom_css'] === "NULL") or (theme('allow_custom_buttons') == "false" and $button['button'] === "custom"))
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $button['button'] }} button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ $button['link'] }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif >@if($button['icon'] == 'llc')<img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/assets/linkstack/icons\/')}}llc.svg">@else<i style="color: {{$button['icon']}}" class="icon hvr-icon fa {{$button['icon']}}"></i>@endif {{ $button['title'] }}</a></div>
                 @elseif($button['button'] === "custom" and $button['custom_css'] != "")
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $button['custom_css'] }}" rel="noopener noreferrer nofollow" href="{{ $button['link'] }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif >@if($button['icon'] == 'llc')<img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/assets/linkstack/icons\/')}}llc.svg">@else<i style="color: {{$button['icon']}}" class="icon hvr-icon fa {{$button['icon']}}"></i>@endif{{ $button['title'] }}</a></div>
                 @elseif($button['button'] === "buy me a coffee")
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-coffee button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ $button['link'] }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/coffee{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}coffee.svg @endif">Buy me a Coffee</a></div>
                 @elseif($button['button'] === "custom_website" and ($button['custom_css'] === "" or $button['custom_css'] === "NULL") or (theme('allow_custom_buttons') == "false" and $button['button'] === "custom_website"))
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-custom_website button button-hover icon-hover" rel="noopener noreferrer nofollow" href="{{ $button['link'] }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($button['id']))){{url('assets/favicon/icons/'.localIcon($button['id']))}}@else{{getFavIcon($button['id'])}}@endif">{{ $button['title'] }}</a></div>
                 @elseif($button['button'] === "custom_website" and $button['custom_css'] != "")
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $button['custom_css'] }}" rel="noopener noreferrer nofollow" href="{{ $button['link'] }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="button-icon" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($button['id']))){{url('assets/favicon/icons/'.localIcon($button['id']))}}@else{{getFavIcon($button['id'])}}@endif">{{ $button['title'] }}</a></div>
                 @elseif($button['button'] === "space")
                 <?php 
                  if (is_numeric($button['title']) and $button['title'] < 10)
                  echo str_repeat("<br>",$button['title']);
                  elseif (is_numeric($button['title']) and $button['title'] >= 10)
                  echo str_repeat("<br>",10);
                  else
                  echo "<br><br><br>"
                  ?>
                 @elseif($button['button'] === "heading")
                 <h2>{{ $button['title'] }}</h2>
                 @else
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $button['button'] }} button button-hover icon-hover" @if($button['link'] != '') href="{{ $button['link'] }}" target="_blank"@endif><img alt="button-icon" class="icon hvr-icon" src="{{ asset('\/assets/linkstack/icons\/') . $linkName }}.svg">{{ ucfirst($linkName) }}</a></div>
                 @endif
                @endforeach
        @else
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-github button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('assets/linkstack/icons/github.svg') }}">Github</div></div>
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-twitter button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('assets/linkstack/icons/twitter.svg') }}">Twitter</div></div>
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><div class="button button-instagram button button-hover icon-hover"><img alt="button-icon" class="icon hvr-icon" src="{{ asset('assets/linkstack/icons/instagram.svg') }}">Instagram</div></div>
        @endif
          
      </div>
    </div>
  </div>

  @if(theme('enable_custom_code') == "true" and theme('enable_custom_body_end') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-body-end')@endif

</body>
</html>