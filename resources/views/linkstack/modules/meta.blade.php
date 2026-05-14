<meta charset="utf-8">

{{-- Fediverse rel="me" links --}}
@php
  $relMe = "mastodon, firefish, streams";
  $relMeList = explode(', ', $relMe);
  $profileUsername = $littlelink_name ?: $userinfo->littlelink_name;
  $profileDisplayName = trim($userinfo->name ?? '');
  $profileTitle = $profileDisplayName !== ''
      ? $profileDisplayName . ' (@' . $profileUsername . ') on Livelatch'
      : $profileUsername . ' on Livelatch';
  $profileDescription = trim(strip_tags(html_entity_decode($userinfo->littlelink_description ?? '', ENT_QUOTES, 'UTF-8')));
  $profileDescription = $profileDescription !== ''
      ? $profileDescription
      : "View {$profileUsername}'s Livelatch profile.";
  $profileUrl = url('/@' . $profileUsername);
  $profileImageUrl = profilePreviewImageUrl($userinfo->id);
@endphp

@foreach($links as $link)
  @if(in_array($link->name, $relMeList))
    <link href="{{$link->link}}" rel="me">
  @endif
@endforeach

@if(env('CUSTOM_META_TAGS') == 'true')
  @include('layouts.meta')
@else
  <meta name="description" content="{{ $profileDescription }}">
  <meta name="author" content="{{ $profileDisplayName ?: $profileUsername }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
@endif

<meta property="og:title" content="{{ $profileTitle }}">
<meta property="og:description" content="{{ $profileDescription }}">
<meta property="og:image" content="{{ $profileImageUrl }}">
<meta property="og:image:type" content="image/svg+xml">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:url" content="{{ $profileUrl }}">
<meta property="og:type" content="profile">
<meta property="og:site_name" content="{{ config('app.name', 'Livelatch') }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $profileTitle }}">
<meta name="twitter:description" content="{{ $profileDescription }}">
<meta name="twitter:image" content="{{ $profileImageUrl }}">

@if(config('advanced-config.linkstack_title') != '' and env('HOME_URL') === '')
<title>{{ $userinfo->name }} {{ config('advanced-config.linkstack_title') }}</title>
@elseif(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.title') != '')
<title>{{ config('advanced-config.title') }}</title>
@elseif(env('HOME_URL') != '')
<title>{{ $userinfo->name }}</title>
@else
<title>{{ $userinfo->name }} 🔗 {{ config('app.name') }} </title>
@endif

@include('components.favicon')
@include('components.favicon-extension')

@if(file_exists(base_path("assets/linkstack/images/").findFile('favicon')))
<link rel="icon" type="image/png" href="{{ asset('assets/linkstack/images/'.findFile('favicon')) }}">
@else
<link rel="icon" type="image/svg+xml" href="{{ asset('assets/linkstack/images/logo.svg') }}">
@endif

@include('layouts.analytics')
