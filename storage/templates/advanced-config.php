<?php

$analytics = 

/*
|--------------------------------------------------------------------------
| Analytics
|--------------------------------------------------------------------------
|
| Add external analytics services to your LinkStack instance by adding them below.
| Everything you enter below will be added to the <head> tag of every page.
| Formatting in plain HTML is expected.
|
*/

<<<EOD
<!----------Insert your analytics code here:---------->



<!--------------------------------------------------->
EOD;;

return [

// Do not change!
'version' => '2.1',

    /*
    |--------------------------------------------------------------------------
    | Default source repository type
    |--------------------------------------------------------------------------
    |
    | Will only be active if "CUSTOM_META_TAGS" is set to "true" in the config.
    | These tags will only be applied to the home page or if a LinkStack page 
    | is set as the homepage in the config (for example: HOME_URL="admin").
    | 
    | Empty entries will be ignored.
    |
    */

    'title'           => '', // Overrides the default meta page title. Leave empty to use your LinkStack page title as the title.
    'description'     => '', // Overrides the default meta page description. Leave empty to use your LinkStack page description as the description.
    'robots'          => 'index,follow',
    'viewport'        => 'width=device-width, initial-scale=1',
    'canonical_url'   => '', // Tells search engines to index "https://example.com/" instead of "https://example.com/@admin", for example.
    'twitter_creator' => '', // Twitter @username.
    'author'          => '', // Your name.

    /*
    |--------------------------------------------------------------------------
    | Additional settings
    |--------------------------------------------------------------------------
    |
    | Empty entries will be ignored.
    |
    */

    // Overwrites default page title after the LinkStack name on LinkStack pages.
    // Example: "admin 🔗 LinkStack"
    //                 ⤌----------⤍
    //                 ⬑ What you can change with this setting.
    'linkstack_title' => '',


    // Either "true", "false" or "auth". 
    // If "auth" is selected, the share button will only be shown to users on their own page.
    'display_share_button' => 'true',

    
    // Do not change here!
    'analytics' => $analytics, // Set on top of page.


    /*
    |--------------------------------------------------------------------------
    | Custom routes
    |--------------------------------------------------------------------------
    |
    | You can change routes to improve security.
    |
    */

    'login_url' => '/login',
    'register_url' => '/register',
    'forgot_password_url' => '/forgot-password',

    'custom_home_url' => '/home', // Only applies if you set a "HOME_URL" in the config.

    // The URL prefix is the symbol that comes before a LinkStack URL.
    // For example the '@' in 'example.com/@admin'.
    // If empty no prefix is required.
    'custom_url_prefix' => '+',
    
    /*
    |--------------------------------------------------------------------------
    | Home Page settings
    |--------------------------------------------------------------------------
    |
    | Empty entries will be ignored.
    |
    */

    // Apply a theme to your Home Page.
    // Enter the name of a theme located in your "themes" folder (for example, 'galaxy').
    'home_theme' => 'default', // Leave empty or enter 'default' to use the default theme.

    /*
    |--------------------------------------------------------------------------
    | Custom Buttons on Home Page
    |--------------------------------------------------------------------------
    |
    | Here you can configure your own buttons for the Home Page.
    | You can add or remove as many buttons as you like.
    | 
    | The syntax of the custom buttons is as follows:
    | 
    |       array(
    |         'button' => '',
    |         'link' => '',
    |         'title' => '',
    |         'icon' => '',
    |         'custom_css' => ''
    |       ),
    | 
    | In the 'button' field, you have to enter the button name (i.e. 'mastodon', 'github', 'custom'...).
    | You can find a list of all available buttons below.
    | 
    | In the 'link' field, you can enter your desired link you may leave this field empty for a display only, non-functional button.
    | 
    | In the 'title' field, changes the text on a button, such as 'custom' and 'custom_website'.
    | 
    | In the 'icon' field, uses the same syntax as the Button Editor on the Admin Panel. 
    | This allows you to add your own icons to 'custom' buttons. You can find a list of available icons on linkstack.org/fa.
    | 
    | In the 'custom_css' field, here you can enter custom CSS to change the color of your button. 
    | If you don't feel comfortable working with CSS,
    | you can copy and paste the CSS from the 'Custom CSS' field of the Button Editor on the Admin Panel.
    |
    */

    'use_custom_buttons'  => 'true', // Set this to false if you wish to display the default dummy buttons.

    'buttons' => array(
      array(
        'button' => 'github',
        'link' => 'https://github.com/linkstackorg/linkstack',
        'title' => 'GitHub',
        'icon' => '',
        'custom_css' => ''
      ),
      array(
        'button' => 'linkstack',
        'link' => 'https://linkstack.org',
        'title' => 'Project Website',
        'icon' => '',
        'custom_css' => ''
      ),
      array(
        'button' => 'custom',
        'link' => 'https://linkstack.org/donate',
        'title' => 'Help us out',
        'icon' => 'fa-hand-holding-heart',
        'custom_css' => 'color:#ffffff; background-image:radial-gradient(circle, #4b1977 0%, #2b0081 95%);'
      ),
    ),

    /*
    |---------------------------------------------------|
    | List of Available buttons:                        |
    |---------------------------------------------------|
    | https://linkstackorg.github.io/buttons/           |
    |---------------------------------------------------|
    */

/*
|--------------------------------------------------------------------------
| Custom Parameters
|--------------------------------------------------------------------------
|
| Add your own custom settings below here.
|~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
*/





/* End of Config! */
];