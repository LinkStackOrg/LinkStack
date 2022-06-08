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

<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=TRACKING_ID"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'TRACKING_ID');
</script>

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
    'title'           => 'Title', // Overrides the default meta page title. Leave empty to use your page title as the title.
    'description'     => 'This is a description', // Overrides the default meta page description. Leave empty to use your page description as the description.
    'robots'          => 'index,follow',
    'viewport'        => 'width=device-width, initial-scale=1',
    'canonical_url'   => 'https://example.com/', // Tells search engines to index "https://example.com/"  instead of "https://example.com/@admin",  for example.
    'twitter_creator' => '@elonmusk', // Twitter @username. For example: "@elonmusk".
    'author'          => 'Julian Prieber', // Your name.

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


    
    // Do not change here!
    'analytics'         => $analytics, // Set on top of page.

];