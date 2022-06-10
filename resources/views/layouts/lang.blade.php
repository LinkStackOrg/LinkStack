@if(env('CUSTOM_META_TAGS') == 'true' and config('advanced-config.lang') != '')
<html lang="{{ config('advanced-config.lang') }}">
@else
<html lang="en">
@endif