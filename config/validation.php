<?php

return [
    // Image extensions (comma separated in .env as VALIDATION_IMAGE_EXTENSIONS)
    'image_extensions' => env('VALIDATION_IMAGE_EXTENSIONS')
        ? array_values(array_filter(explode(',', env('VALIDATION_IMAGE_EXTENSIONS'))))
        : ['jpeg', 'jpg', 'png', 'webp', 'gif'],

    'rich_text' => [
        // Allowed tags (comma separated in .env as VALIDATION_RICH_TEXT_ALLOWED_TAGS)
        'allowed_tags' => env('VALIDATION_RICH_TEXT_ALLOWED_TAGS')
            ? array_values(array_filter(explode(',', env('VALIDATION_RICH_TEXT_ALLOWED_TAGS'))))
            : ['a', 'p', 'strong', 'i', 'ul', 'ol', 'li', 'blockquote', 'h2', 'h3', 'h4', 'br'],
        // Allowed protocols (comma separated in .env as VALIDATION_RICH_TEXT_ALLOWED_PROTOCOLS)
        'allowed_protocols' => env('VALIDATION_RICH_TEXT_ALLOWED_PROTOCOLS')
            ? array_values(array_filter(explode(',', env('VALIDATION_RICH_TEXT_ALLOWED_PROTOCOLS'))))
            : ['http', 'https', 'mailto', 'tel'],
    ],

    'url' => [
        // Allowed schemes for URLs (comma separated in .env as VALIDATION_URL_ALLOWED_SCHEMES)
        'allowed_schemes' => env('VALIDATION_URL_ALLOWED_SCHEMES')
            ? array_values(array_filter(explode(',', env('VALIDATION_URL_ALLOWED_SCHEMES'))))
            : ['http', 'https', 'mailto', 'tel'],
    ],

    // Disallowed characters and phrases can be overridden via .env as comma-separated lists
    'disallowed_characters' => env('VALIDATION_DISALLOWED_CHARACTERS')
        ? array_values(array_filter(explode(',', env('VALIDATION_DISALLOWED_CHARACTERS'))))
        : [' ', '/', '\\', '?', '#', '%', '<', '>', ':', '&'],

    'disallowed_phrases' => env('VALIDATION_DISALLOWED_PHRASES')
        ? array_values(array_filter(explode(',', env('VALIDATION_DISALLOWED_PHRASES'))))
        : ['admin', 'root', 'support', 'www', 'http', 'https'],

    // Length constraints (use VALIDATION_<FIELD>_MIN / MAX in .env to override)
    'lengths' => [
        'name' => [
            'min' => (int) env('VALIDATION_NAME_MIN', 1),
            'max' => (int) env('VALIDATION_NAME_MAX', 255),
        ],
        // Friendly name: "handle" maps to the DB field `littlelink_name`
        'handle' => [
            'min' => (int) env('VALIDATION_HANDLE_MIN', 3),
            'max' => (int) env('VALIDATION_HANDLE_MAX', 50),
        ],
        'email' => [
            'max' => (int) env('VALIDATION_EMAIL_MAX', 255),
        ],
        'password' => [
            'min' => (int) env('VALIDATION_PASSWORD_MIN', 8),
            'max' => (int) env('VALIDATION_PASSWORD_MAX', 128),
        ],
    ],
];