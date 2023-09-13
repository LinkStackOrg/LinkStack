<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers to be used while
    | sending an e-mail. You will specify which one you are using for your
    | mailers below. You are free to add additional mailers as required.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array"
    |
    */

    'mailers' => [
        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL', '/usr/sbin/sendmail -bs'),
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS'),
                'name' => env('MAIL_FROM_NAME'),
            ]
        ],
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_PORT'),
            'encryption' => env('MAIL_ENCRYPTION'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'auth_mode' => null,
        'from' => [
			'address' => env('MAIL_FROM_ADDRESS'),
			'name' => env('MAIL_FROM_NAME'),
			],
        ],


    /*
    |--------------------------------------------------------------------------
    | Built in SMTP server
    |--------------------------------------------------------------------------
    |
    | LinkStack now includes an open and free to use SMTP server. 
    | Mails from this service may only be used for
    | password recovery and registration purposes involving
    | users personal LinkStack or LittleLink Admin pages.
    | Users of this service must abide by our Terms and Conditions
    | found at https://linkstack.org/mail.
    |
    */

        'built-in' => [
            'transport' => 'smtp',
            'host' => 'mail.llc.ovh',
            'port' => '587',
            'encryption' => 'tls',
            'username' => 'littlelink-custom@mail.llc.ovh',
            'password' => 'qWrf<S7sP5',
            'timeout' => null,
            'auth_mode' => null,
        'from' => [
			'address' => 'littlelink-custom@mail.llc.ovh',
			'name' => env('MAIL_FROM_NAME'),
			],
        ],

    ],


    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
