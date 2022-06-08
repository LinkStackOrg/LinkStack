@if(env('CUSTOM_META_TAGS') == 'true' and Config::get('meta.lang') != '')
<html lang="{{ Config::get('meta.lang') }}">
@else
@include('layouts.lang')
@endif