<?php use App\Models\UserData; ?>

<!DOCTYPE html>
@include('layouts.lang')
<head>
  <meta charset="utf-8">

{{-- Fediverse rel="me" links --}}
@php
  $relMe = "mastodon, firefish";
  $relMeList = explode(', ', $relMe);
@endphp

@foreach($links as $link)
  @if(in_array($link->name, $relMeList))
    <link href="{{$link->link}}" rel="me">
  @endif
@endforeach

<?php
// Theme Config
if (!function_exists('theme')) {
  function theme($key){
$key = trim($key);
$file = base_path('themes/' . $GLOBALS['themeName'] . '/config.php');
  if (file_exists($file)) {
    $config = include $file;
  if (isset($config[$key])) {
    return $config[$key];
}}
return null;}
}

// Theme Custom Asset
if (!function_exists('themeAsset')) {
function themeAsset($path){
$path = url('themes/' . $GLOBALS['themeName'] . '/extra/custom-assets/' . $path);
return $path;}
}
?>

@foreach($information as $info) @php $GLOBALS['themeName'] = $info->theme; @endphp @endforeach

@if(theme('enable_custom_code') == "true" and theme('enable_custom_head') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-head')@endif

@include('layouts.analytics')

  @if(config('advanced-config.linkstack_title') != '' and env('HOME_URL') === '')
  <title>{{ $userinfo->name }} {{ config('advanced-config.linkstack_title') }}</title>
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

@if(theme('allow_custom_background') != "false")
@php
$customBackgroundFile = findBackground($userinfo->id);
$customBackgroundPath = base_path('assets/img/background-img/'.$customBackgroundFile);
$customBackgroundURL = url('assets/img/background-img/'.$customBackgroundFile);
$customBackgroundExists = file_exists($customBackgroundPath);
if($customBackgroundExists == true){
  $customBackgroundBrightness = analyzeImageBrightness($customBackgroundFile);
    } else {
 $customBackgroundBrightness = false;}
@endphp

@if($customBackgroundExists == true)
<style>
  body {
    background-image: url('{{$customBackgroundURL}}') !important;
    background-size: cover !important;
    background-attachment: fixed !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
  }
</style>
@endif
@endif

<!--#### BEGIN Meta Tags social media preview images  ####-->
  <!-- This shows a preview for title, description and avatar image of users profiles if shared on social media sites -->

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $userinfo->name }}">
    <meta property="og:description" content="{{ strip_tags($userinfo->littlelink_description) }}">
    @if(file_exists(base_path(findAvatar($userinfo->id))))
    <meta property="og:image" content="{{ url(findAvatar($userinfo->id)) }}">
    @elseif(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
    <meta property="og:image" content="{{ url("assets/linkstack/images/")."/".findFile('avatar') }}">
    @else
    <meta property="og:image" content="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta property="twitter:url" content="{{ url('') }}/{{ "@" . $littlelink_name }}">
    <meta name="twitter:title" content="{{ $userinfo->littlelink_name }}">
    <meta name="twitter:description" content="{{ strip_tags($userinfo->littlelink_description) }}">
    @if(file_exists(base_path(findAvatar($userinfo->id))))
    <meta name="twitter:image" content="{{ url(findAvatar($userinfo->id)) }}">
    @elseif(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
    <meta name="twitter:image" content="{{ url("assets/linkstack/images/")."/".findFile('avatar') }}">
    @else
    <meta name="twitter:image" content="{{ asset('assets/linkstack/images/logo.svg') }}">
    @endif

<!--#### END Meta Tags social media preview images  ####-->

  <!-- Custom icons font-awesome -->
  {{-- <script>{!! file_get_contents(base_path("assets/external-dependencies/fontawesome.js")) !!}</script> --}}
  <style>{!! str_replace('../', 'studio/', file_get_contents(base_path("assets/external-dependencies/fontawesome.css"))) !!}</style>

  @include('layouts.fonts')
  <style>{!! file_get_contents(base_path("assets/linkstack/css/normalize.css")) !!}</style>
  <style>{!! file_get_contents(base_path("assets/linkstack/css/animate.css")) !!}</style>
  @if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
  <link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
  @else
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
  @endif

@foreach($information as $info)
@if($info->theme != '' and $info->theme != 'default')

  <!-- LinkStack Theme: "{{$info->theme}}" -->

  <!-- Theme details: -->
  <meta name="designer" href="{{ url('') . "/theme/@" . $littlelink_name}}" content="{{ url('') . "/theme/@" . $littlelink_name}}">

  <link rel="stylesheet" href="themes/{{$info->theme}}/share.button.css">
  @if(theme('use_default_buttons') == "true")
  <link rel="stylesheet" href="{{ asset('assets/linkstack/css/brands.css') }}">
  @else
  <link rel="stylesheet" href="themes/{{$info->theme}}/brands.css">
  @endif
  <link rel="stylesheet" href="themes/{{$info->theme}}/skeleton-auto.css">
@if(file_exists(base_path('themes/' . $info->theme . '/animations.css')))
  <link rel="stylesheet" href="<?php echo asset('themes/' . $info->theme . '/animations.css') ?>">
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

@if($ShowShrBtn == 'true' and UserData::getData($userinfo->id, 'disable-sharebtn') != "true")

<script>{!! file_get_contents(base_path("assets/linkstack/js/jquery.min.js")) !!}</script>
<div align="right" class="sharediv">
  <div>
    <span class="sharebutton button-hover icon-hover share-button" data-share="{{url()->current()}}" tabindex="0" role="button" aria-label="{{__('messages.Share this page')}}">
      <i style="color: black;" class="fa-solid fa-share sharebutton-img share-icon hvr-icon"></i>
      <span class="sharebutton-mb">{{__('messages.Share')}}</span>
    </span>
  </div>
</div>
<span class="copy-icon" tabindex="0" role="button" aria-label="{{__('messages.Copy URL to clipboard')}}">
</span>

<script>
  const shareButtons = document.querySelectorAll('.share-button');
  shareButtons.forEach(button => {
    button.addEventListener('click', () => {
      const valueToShare = button.dataset.share;
      if (navigator.share) {
        navigator.share({
          title: "{{__('messages.Share this page')}}",
          url: valueToShare
        })
        .catch(err => console.error('Error:', err));
      } else {
        navigator.clipboard.writeText(valueToShare)
        .then(() => {
          alert("{{__('messages.URL has been copied to your clipboard!')}}");
        })
        .catch(err => {
          alert('Error', err);
        });
      }
    });
  });
</script>


@endif
<?php ////end share button//// ?>

  <div class="container">
    <div class="row">
      <div class="column" style="margin-top: 5%">
        <!-- Your Image Here -->
          @if(file_exists(base_path(findAvatar($userinfo->id))))
          <img alt="avatar" class="rounded-avatar fadein" src="{{ url(findAvatar($userinfo->id)) }}" height="128px" width="128px" style="object-fit: cover;">
          @elseif(file_exists(base_path("assets/linkstack/images/").findFile('avatar')))
          <img alt="avatar" class="fadein" src="{{ url("assets/linkstack/images/")."/".findFile('avatar') }}" height="128px" width="128px" style="object-fit: cover;">
          @else
          <img alt="avatar" class="fadein" src="{{ asset('assets/linkstack/images/logo.svg') }}" height="128px" style="width:auto;min-width:128px;object-fit: cover;">
          @endif

        <!-- Your Name -->
        <h1 class="fadein">{{ $info->name }}@if(($userinfo->role == 'vip' or $userinfo->role == 'admin') and theme('disable_verification_badge') != "true" and env('HIDE_VERIFICATION_CHECKMARK') != true and UserData::getData($userinfo->id, 'checkmark') != false)<span title="{{__('messages.Verified user')}}">@include('components.verify-svg')@endif</span></h1>

        <!-- Short Bio -->
        <style>.description-parent * {margin-bottom: 1em;}.description-parent {padding-bottom: 30px;}</style>
        <center><div class="fadein description-parent"><p class="fadein">@if(env('ALLOW_USER_HTML') === true){!! $info->littlelink_description !!}@else{{ $info->littlelink_description }}@endif</p></div></center>

        <!-- Icons -->
        @php $icons = DB::table('links')->where('user_id', $userinfo->id)->where('button_id', 94)->get(); @endphp
        @if(count($icons) > 0)
        <div class="row fadein social-icon-div">
        @foreach($icons as $icon)
        <a class="social-hover social-link" href="{{ route('clickNumber') . '/' . $icon->id. "?" . $icon->link}}" title="{{ucfirst($icon->title)}}" aria-label="{{ucfirst($icon->title)}}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif><i class="social-icon fa-brands fa-{{$icon->title}}"></i></a>
        @endforeach
        </div>
        @endif

        @endforeach

        <!-- Buttons -->
        @php $initial = 1; @endphp

        @foreach($links as $link)
        @php $linkName = str_replace('default ','',$link->title) @endphp
        @switch($link->name)
            @case('icon')
                @break
            @case('phone')
            <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-default button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}"><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/phone{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}phone.svg @endif"></i>{{ $link->title }}</a></div>
                @break
            @case('default email')
            @case('default email_alt')
            <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-default button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}"><img alt="email" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/email{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}email.svg @endif"></i>{{ $link->title }}</a></div>
                @break
            @case('buy me a coffee')
            <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-coffee button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/coffee{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}coffee.svg @endif">Buy me a Coffee</a></div>
                @break
                   @case('space')
                   @php $title = $link->title; if (is_numeric($title)) { echo str_repeat("<br>", $title < 10 ? $title : 10); } else { echo "<br><br><br>"; } @endphp
                @break
            @case('heading')
            <div class="fadein"><h2>{{ $link->title }}</h2></div>
                @break
            @case('text')
            <div class="fadein"><span style="">@if(env('ALLOW_USER_HTML') === true){!! $link->title !!}@else{{ $link->title }}@endif</span></div>
                @break
            @case('vcard')
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-default button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('vcard') . '/' . $link->id }}"><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/vcard{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/')}}vcard.svg @endif"></i>{{ $link->title }}</a></div>
                    @break
            @case('custom')
              @if($link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false"))
               <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
                  @break
               @elseif($link->custom_css != "")
               <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><i style="color: {{$link->custom_icon}}" class="icon hvr-icon fa {{$link->custom_icon}}"></i>{{ $link->title }}</a></div>
                  @break
                @endif
            @case('custom_website')
               @if($link->custom_css === "" or $link->custom_css === "NULL" or (theme('allow_custom_buttons') == "false"))
                 <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-custom_website button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id))){{url('assets/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif" onerror="this.onerror=null; this.src='{{asset('assets/linkstack/icons/website.svg')}}';">{{ $link->title }}</a></div>
                   @break
               @elseif($link->custom_css != "")
                <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-hover icon-hover" style="{{ $link->custom_css }}" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(file_exists(base_path("assets/favicon/icons/").localIcon($link->id))){{url('assets/favicon/icons/'.localIcon($link->id))}}@else{{getFavIcon($link->id)}}@endif" onerror="this.onerror=null; this.src='{{asset('assets/linkstack/icons/website.svg')}}';">{{ $link->title }}</a></div>
                 @break
               @endif
               @default
            <?php include base_path('config/button-names.php'); $newLinkName = $linkName; $isNewName = "false"; foreach($buttonNames as $key => $value) { if($newLinkName == $key) { $newLinkName = $value; $isNewName = "true"; }} ?>
            <div style="--delay: {{ $initial++ }}s" class="button-entrance"><a class="button button-{{ $link->name }} button button-hover icon-hover" rel="noopener noreferrer nofollow noindex" href="{{ route('clickNumber') . '/' . $link->id . "?" . $link->link }}" @if(theme('open_links_in_same_tab') != "true")target="_blank"@endif ><img alt="{{ $link->name }}" class="icon hvr-icon" src="@if(theme('use_custom_icons') == "true"){{ url('themes/' . $GLOBALS['themeName'] . '/extra/custom-icons')}}/{{$link->name}}{{theme('custom_icon_extension')}} @else{{ asset('\/assets/linkstack/icons\/') . $link->name }}.svg @endif">@if($isNewName == "true"){{ ucfirst($newLinkName) }}@else{{ ucfirst($newLinkName) }}@endif</a></div>
        @endswitch
    @endforeach

        @include('layouts.footer')

      </div>
    </div>
  </div>

@if(theme('enable_custom_code') == "true" and theme('enable_custom_body_end') == "true" and env('ALLOW_CUSTOM_CODE_IN_THEMES') == 'true')@include($GLOBALS['themeName'] . '.extra.custom-body-end')@endif

</body>
</html>
