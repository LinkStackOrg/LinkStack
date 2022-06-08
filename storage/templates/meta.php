<?php



$analytics = 

/*
|--------------------------------------------------------------------------
| Analytics
|--------------------------------------------------------------------------
|
| Add external analytics services to your LittleLink Custom instance by adding them below.
| Everything you enter below will be added to the <head> tag of every page.
| Formatting in plain HTML is expected.
|
*/

<<<EOD
<!----------Insert your analytics code here:---------->



<!--------------------------------------------------->
EOD;;



return [

    /*
    |--------------------------------------------------------------------------
    | Default source repository type
    |--------------------------------------------------------------------------
    |
    | Will only be active if "CUSTOM_META_TAGS" is set to "true" in the config.
    | These tags will only be applied to the home page or if a LittleLink page is set as the homepage in the config
    | (For example: HOME_URL="@admin").
    | 
    | Empty entries will be ignored.
    |
    */

    'lang'            => 'en', // Sets <html lang="en">
    'title'           => '', // Overrides the default meta page title. Leave empty to use your LittleLink page title as the title.
    'description'     => '', // Overrides the default meta page description. Leave empty to use your LittleLink page description as the description.
    'robots'          => 'index,follow',
    'viewport'        => 'width=device-width, initial-scale=1',
    'canonical_url'   => '', // Tells search engines to index "https://example.com/"  instead of "https://example.com/@admin",  for example.
    'twitter_creator' => '', // Twitter @username. For example: "@elonmusk".
    'author'          => '', // Your name.

    /*
    |--------------------------------------------------------------------------
    | Additional settings
    |--------------------------------------------------------------------------
    |
    | Empty entries will be ignored.
    |
    */


    // Overwrites default theme regardless of preference defined by the operating system, unless manually overwritten by user.
    'theme'             => '', // Either "dark" or "light".


    // Overwrites default theme regardless of preference defined by the operating system, unless manually overwritten by user.
    // Overwrites default page title after the LittleLink name on LittleLink pages.
    // Example: "admin 🔗 LittleLink Custom"
    //                 ⤌------------------⤍
    //                 ⬑ What you can change with this setting.
    'littlelink_title'  => '',


    // Either "true", "false" or "auth". 
    // If "auth" is selected, the share button will only be shown to users on their own page.
    'display_share_button' => 'true',

    
    // Do not change here!
    'analytics'         => $analytics, // Set on top of page.

];