<?php
$analyticsHTML = Config::get('meta.analytics');
$analyticsHTML = preg_replace("~<!--(.*?)-->~s", "", $analyticsHTML);
$analyticsHTML = trim($analyticsHTML);
?>

@if(preg_replace( "/\r|\n/", "", $analyticsHTML ) != '')
<!-- Analytics -->

{!! $analyticsHTML !!}

<!-- /Analytics -->
@endif
