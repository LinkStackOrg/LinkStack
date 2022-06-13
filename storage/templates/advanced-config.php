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
    | These tags will only be applied to the home page or if a LittleLink page 
    | is set as the homepage in the config (for example: HOME_URL="admin").
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
    | All settings below are always active
    |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    */

    /*
    |--------------------------------------------------------------------------
    | Additional settings
    |--------------------------------------------------------------------------
    |
    | Empty entries will be ignored.
    |
    */


    // Overwrites default theme regardless of preference defined by the operating system, unless manually overwritten by user.
    'theme' => '', // Either "dark" or "light".


    // Overwrites default page title after the LittleLink name on LittleLink pages.
    // Example: "admin 🔗 LittleLink Custom"
    //                 ⤌------------------⤍
    //                 ⬑ What you can change with this setting.
    'littlelink_title' => '',


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

    // If 'true' the Home Page will be disabled entirely.
    // You will still be able to login on the login page etc.
    'disable_home_page' => 'false', // Either 'true', 'false' or 'redirect'.
    'redirect_home_page' => 'https://littlelink-custom.com', // Only active if value above is set to 'redirect'.

    // The URL prefix is the symbol that comes before a LittleLink URL.
    // For example the '@' in 'example.com/@admin'.
    // If empty no prefix is required. Use with caution.
    'custom_url_prefix' => '+', // The '@' prefix will always work regardless of this setting.


    /*
    |--------------------------------------------------------------------------
    | Footer links
    |--------------------------------------------------------------------------
    |
    | Footer links are the links that are displayed on the bottom of your page, reading: "Home, Terms, Privacy, Contact".
    | You can toggle each individual link on or off. 
    | You can also set a custom URL for the "Home" link.
    |
    */

    // Either "true" or "false".
    'display_link_home' => 'true',
    'display_link_terms' => 'true',
    'display_link_privacy' => 'true',
    'display_link_contact' => 'true',

    // Enter a custom home link (for example, 'https://littlelink-custom.com').
    'custom_link_home' => '', // Leave empty to use default value.
    // Changes the text on the "Home" link.
    'custom_text_home' => 'Home', // Leave empty to use default value.
    
    /*
    |--------------------------------------------------------------------------
    | Home Page settings
    |--------------------------------------------------------------------------
    |
    | To change footer text on the Home Page, set the setting 'footer' to your preference.
    | 
    | The footer text is the towards the bottom of the Home Page that reads: "and X other buttons ..."
    | 
    | Depending on the amount of buttons on your Home Page, you might want to change this text.
    | 
    | 'default' -> Uses default text.
    | 'alt'  ->  Displays an alternative version based on the Button Editor.
    | 'custom'  ->  Displays your custom text defined with 'custom_footer_text'.
    | 'false'  ->  Removes the footer.
    |
    */

    'home_footer' => 'default', // Either 'default', 'alt', 'custom' or 'false'.

    // You can enter plain text or HTML into this field.
    // You can use "{year}" as a placeholder for the current year.
    // So "©{year}" would output "©2033" (or whatever the current year is).
    'custom_home_footer_text' => '© Copyright {year} - All Rights Reserved',


    // Apply a theme to your Home Page.
    // Some themes are not compatible with the Home Page. Use at your own discretion.
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
    | In the 'button' field, you have to enter the button name (i.e. 'twitter', 'github', 'custom'...).
    | You can find a list of all available buttons below.
    | 
    | In the 'link' field, you can enter your desired link you may leave this field empty for a display only, non-functional button.
    | 
    | 
    | 
    | The input fields below only apply to buttons such as 'custom' and 'custom_website' but must always be included even if only empty.
    |~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    | 
    | In the 'title' field, changes the text on a button, such as 'custom' and 'custom_website'.
    | 
    | In the 'icon' field, uses the same syntax as the Button Editor on the Admin Panel. 
    | This allows you to add your own icons to 'custom' buttons. You can find a list of available icons on llc.bio/fa.
    | 
    | In the 'custom_css' field, here you can enter custom CSS to change the color of your button. 
    | If you don't feel comfortable working with CSS,
    | you can copy and paste the CSS from the 'Custom CSS' field of the Button Editor on the Admin Panel.
    |
    */

    'use_custom_buttons'  => 'true', // Set this to false if you wish to display the old buttons.

    'buttons' => array(
      array(
        'button' => 'github',
        'link' => 'https://github.com/JulianPrieber/littlelink-custom',
        'title' => '',
        'icon' => '',
        'custom_css' => ''
      ),
      array(
          'button' => 'custom',
          'link' => 'https://littlelink-custom.com',
          'title' => 'Project Website',
          'icon' => 'llc',
          'custom_css' => 'color:#ffffff; background-image:linear-gradient(76deg, #f70fff 0%, #11d4de 100%);'),
      array(
        'button' => 'custom',
        'link' => 'https://littlelink-custom.com/sponsor',
        'title' => 'Help us out',
        'icon' => 'fa-hand-holding-heart',
        'custom_css' => 'color:#ffffff; background-image:radial-gradient(circle, #00d2ff 0%, #3a7bd5 95%);'
      ),
    )

    /*
    |--------------------------------|
    | List of Available buttons:     |
    |--------------------------------|
    | 'button' => 'custom'           |
    | 'button' => 'custom_website'   |
    | 'button' => 'github'           |
    | 'button' => 'twitter'          |
    | 'button' => 'instagram'        |
    | 'button' => 'facebook'         |
    | 'button' => 'messenger'        |
    | 'button' => 'linkedin'         |
    | 'button' => 'youtube'          |
    | 'button' => 'discord'          |
    | 'button' => 'twitch'           |
    | 'button' => 'snapchat'         |
    | 'button' => 'spotify'          |
    | 'button' => 'reddit'           |
    | 'button' => 'medium'           |
    | 'button' => 'pinterest'        |
    | 'button' => 'soundcloud'       |
    | 'button' => 'figma'            |
    | 'button' => 'kit'              |
    | 'button' => 'telegram'         |
    | 'button' => 'tumblr'           |
    | 'button' => 'steam'            |
    | 'button' => 'vimeo'            |
    | 'button' => 'wordpress'        |
    | 'button' => 'goodreads'        |
    | 'button' => 'skoob'            |
    | 'button' => 'tiktok'           |
    | 'button' => 'default email'    |
    | 'button' => 'default email_alt'|
    | 'button' => 'bandcamp'         |
    | 'button' => 'patreon'          |
    | 'button' => 'signal'           |
    | 'button' => 'venmo'            |
    | 'button' => 'cashapp'          |
    | 'button' => 'gitlab'           |
    | 'button' => 'mastodon'         |
    | 'button' => 'paypal'           |
    | 'button' => 'whatsapp'         |
    | 'button' => 'xing'             |
    | 'button' => 'buy me a coffee'  |
    | 'button' => 'website'          |
    | 'button' => 'heading'          |
    | 'button' => 'space'            |
    |--------------------------------|
    */

];