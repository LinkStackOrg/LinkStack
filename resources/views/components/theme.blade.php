@extends('layouts.updater')
@foreach($information as $info)

@Push('updater-head')
<title>{{ $userinfo->name }} 🌇 {{ ucfirst(trans($info->theme)) }} </title>
<meta name="robots" content="noindex">
<style>
.container-theme {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
 }

.container-theme pre {
  display: inline-block;
  text-align: left;
 }
</style>
@endpush

@Push('updater-body')


@if(file_exists(base_path("themes/$info->theme/readme.md")))


<div class="container-theme">
<h1>Theme: {{ ucfirst(trans($info->theme)) }}</h1>

<?php
$str = file_get_contents('themes/' . $info->theme . '/readme.md');
$url_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';   
$str= preg_replace($url_pattern, '<a href="$0">$0</a>', $str);
$txtspc = '<pre>' . $str . '</pre>';
echo preg_replace('/[ \t]+/', ' ', preg_replace('/\s\S*$^\s\S*/m', "\n", $txtspc));
?>

</div>

@else
<div class="container"><p>File not found</p></div>
@endif


@endforeach
@endpush