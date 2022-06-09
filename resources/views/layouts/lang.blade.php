@if(env('CUSTOM_META_TAGS') == 'true' and config('meta.lang') != '')
<html lang="{{ config('meta.lang') }}">
@else
<html lang="en">
@endif