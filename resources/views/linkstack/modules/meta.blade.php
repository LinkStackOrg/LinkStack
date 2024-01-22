<meta charset="utf-8">

{{-- Fediverse rel="me" links --}}
@php
  $relMe = "mastodon, firefish, streams";
  $relMeList = explode(', ', $relMe);
@endphp

@foreach($links as $link)
  @if(in_array($link->name, $relMeList))
    <link href="{{$link->link}}" rel="me">
  @endif
@endforeach

@if(env('CUSTOM_META_TAGS') == 'true')
  @include('layouts.meta')
@else
  <meta name="description" content="{{ strip_tags($userinfo->littlelink_description) }}">
  <meta name="author" content="{{ $userinfo->name }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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