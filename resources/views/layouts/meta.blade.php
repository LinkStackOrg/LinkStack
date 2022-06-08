@if(Config::get('meta.description') != '')<meta name="description" content="{{ Config::get('meta.description') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="description" content="{{ $userinfo->littlelink_description }}">
@else<meta name="description" content="{{ $cleaner_input }}">@endif

@if(Config::get('meta.author') != '')<meta name="author" content="{{ Config::get('meta.author') }}">
@elseif(Route::currentRouteName() != 'home')<meta name="author" content="{{ $userinfo->name }}">@endif

@if(Config::get('meta.viewport') != '')<meta name="viewport" content="{{ Config::get('meta.viewport') }}"/>
@else<meta name="viewport" content="width=device-width, initial-scale=1">@endif

@if(Config::get('meta.robots') != '')<meta name="robots" content="{{ Config::get('meta.robots') }}">@endif

@if(Config::get('meta.canonical_url') != '')<link rel="canonical" href="{{ Config::get('meta.canonical_url') }}">@endif

@if(Config::get('meta.twitter_creator') != '')<meta name="twitter:creator" content="{{ Config::get('meta.twitter_creator') }}">@endif
