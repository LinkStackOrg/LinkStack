@if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.lang') != '')
<html lang="{{ config('advanced-config.lang') }}">
@else
<html lang="en">
@endif


{{-- Redirects to https if enabled in the advanced-config --}}
@if(config('advanced-config.redirect_https') == 'true')
@php
if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect_url");
    exit();
}
@endphp
@endif
