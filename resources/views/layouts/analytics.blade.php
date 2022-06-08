<?php
$analyticsHTML = Config::get('meta.analytics');
$analyticsHTML = preg_replace("~<!--(.*?)-->~s", "", $analyticsHTML);
$analyticsHTML = preg_replace('/[ \t]+/', ' ', preg_replace('/\s\S*$^\s\S*/m', "\n", $analyticsHTML));
$analyticsHTML = trim($analyticsHTML);
?>

@if(preg_replace( "/\r|\n/", "", $analyticsHTML ) != '')
<!-- Analytics -->

{!! $analyticsHTML !!}

<!-- /Analytics -->
@endif
