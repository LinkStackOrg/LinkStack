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
$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

$text = file_get_contents('themes/' . $info->theme . '/readme.md');

if(preg_match($reg_exUrl, $text, $url)) {

       $txtspc = '<pre>' . preg_replace($reg_exUrl, "<a href=" . $url[0] . ">$url[0]</a> ", $text) . '</pre>';
       echo preg_replace('/[ \t]+/', ' ', preg_replace('/\s\S*$^\s\S*/m', "\n", $txtspc));

} else {

       echo '<pre>' . preg_replace('/[ \t]+/', ' ', preg_replace('/\s\S*$^\s\S*/m', "\n", $txtspc)) . '</pre>';

}
?>
</div>

@else
<div class="container"><p>File not found</p></div>
@endif


@endforeach
@endpush