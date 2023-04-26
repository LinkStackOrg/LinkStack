<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme Config
    |--------------------------------------------------------------------------
    |
    | The theme config allows you to configure how LittleLink Custom should treat your theme.
    | All settings can either be set to "true" or "false", unless stated otherwise.
    | 
    | The settings below change how your buttons behave.
    |
    */

    // Some themes may not be compatible with custom buttons created by the Button Editor.
    // If 'false' the default button CSS is used.
    'allow_custom_buttons' => 'false',

    'open_links_in_same_tab' => 'false',


    /*
    |--------------------------------------------------------------------------
    | Custom Code
    |--------------------------------------------------------------------------
    |
    | Custom code allows you to inject customized Blade, PHP, HTML, JavaScript and CSS code.
    | 
    | In your "extra" folder, you will find 3 separate files for injecting your code to 
    | different places on the final page (head, body, at the end of the body).
    | 
    | You may also attach custom assets like CSS, JS, or images. 
    | You can find instructions for this in the files in your extra folder.
    | 
    */

    'enable_custom_code' => 'false',

    // Disable individual files (only applies if above is 'true').
    'enable_custom_head'     => 'true',
    'enable_custom_body'     => 'true',
    'enable_custom_body_end' => 'true',


    /*
    |--------------------------------------------------------------------------
    | Custom Icons
    |--------------------------------------------------------------------------
    |
    | You may add custom icons to your theme. 
    | These icons are stored under: .../extra/custom-icons.
    | 
    | You can adjust the file extension types to use other files than just SVGs.
    |
    */

    'use_custom_icons' => 'false',

    // Is not set correct this will cause errors.
    'custom_icon_extension' => '.svg', // (.png, .jpg ...)



];