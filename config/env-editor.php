<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Files Config
    |--------------------------------------------------------------------------
    */
    'paths' => [
        // .env file directory
        'env' => base_path(),
        //backup files directory
        'backupDirectory' => 'backups',
    ],
    // .env file name
    'envFileName' => '.env',

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    */
    'route' => [
        // Prefix url for route Group
        'prefix' => 'env-editor',
        // Routes base name
        'name' => 'env-editor',
        // Middleware(s) applied on route Group
        'middleware' => ['web', 'admin'],
    ],

    /* ------------------------------------------------------------------------------------------------
    |  Time Format for Views and parsed backups
    | ------------------------------------------------------------------------------------------------
    */
    'timeFormat' => 'd/m/Y H:i:s',

    /* ------------------------------------------------------------------------------------------------
     | Set Views options
     | ------------------------------------------------------------------------------------------------
     | Here you can set The "extends" blade of index.blade.php
    */
    'layout' => 'env-editor::layout',

];
