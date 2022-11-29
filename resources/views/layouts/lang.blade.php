@if(env('FORCE_HTTPS') == 'true')<?php URL::forceScheme('https');  ?>@endif
@if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.lang') != '')
<html lang="{{ config('advanced-config.lang') }}">
@else
<html lang="en">
@endif

@php
function findFile($name){
            $directory = base_path('/littlelink/images/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, $name.'.') !== false) {
            $pathinfo = $name. "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            return $pathinfo;
    }
@endphp

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
