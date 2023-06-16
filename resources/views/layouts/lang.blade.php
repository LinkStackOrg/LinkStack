@if(env('FORCE_HTTPS') == 'true')<?php URL::forceScheme('https'); header("Content-Security-Policy: upgrade-insecure-requests"); ?>@endif
<html lang="{{ config('app.locale') }}">

{{-- Redirects to https if enabled in the advanced-config --}}
@if(env('FORCE_ROUTE_HTTPS') == 'true')
@php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}
@endphp
@endif
