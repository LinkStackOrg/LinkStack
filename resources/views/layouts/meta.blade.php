@if(config('meta.description') != '')<meta name="description" content="{{ config('meta.description') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="description" content="{{ $userinfo->littlelink_description }}">
@else<meta name="description" content="{{ $cleaner_input }}">@endif

@if(config('meta.author') != '')<meta name="author" content="{{ config('meta.author') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="author" content="{{ $userinfo->name }}">@endif

@if(config('meta.viewport') != '')<meta name="viewport" content="{{ config('meta.viewport') }}"/>
@else<meta name="viewport" content="width=device-width, initial-scale=1">@endif

@if(config('meta.robots') != '')<meta name="robots" content="{{ config('meta.robots') }}">@endif

@if(config('meta.canonical_url') != '')<link rel="canonical" href="{{ config('meta.canonical_url') }}">@endif

@if(config('meta.twitter_creator') != '')<meta name="twitter:creator" content="{{ config('meta.twitter_creator') }}">@endif
