@if(config('advanced-config.description') != '')<meta name="description" content="{{ config('advanced-config.description') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="description" content="{{ $userinfo->littlelink_description }}">
@else<meta name="description" content="{{ $cleaner_input }}">@endif

@if(config('advanced-config.author') != '')<meta name="author" content="{{ config('advanced-config.author') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="author" content="{{ $userinfo->name }}">@endif

@if(config('advanced-config.viewport') != '')<meta name="viewport" content="{{ config('advanced-config.viewport') }}"/>
@else<meta name="viewport" content="width=device-width, initial-scale=1">@endif

@if(config('advanced-config.robots') != '')<meta name="robots" content="{{ config('advanced-config.robots') }}">@endif

@if(config('advanced-config.canonical_url') != '')<link rel="canonical" href="{{ config('advanced-config.canonical_url') }}">@endif

@if(config('advanced-config.twitter_creator') != '')<meta name="twitter:creator" content="{{ config('advanced-config.twitter_creator') }}">@endif
