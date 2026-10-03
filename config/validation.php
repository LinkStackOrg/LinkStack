<?php

return [
    'image_extensions' => ['jpeg', 'jpg', 'png', 'webp', 'gif'],

    'rich_text' => [
        'allowed_tags' => ['a', 'p', 'strong', 'i', 'ul', 'ol', 'li', 'blockquote', 'h2', 'h3', 'h4', 'br'],
        'allowed_protocols' => ['http', 'https', 'mailto', 'tel'],
    ],

    'url' => [
        'allowed_schemes' => ['http', 'https', 'mailto', 'tel'],
    ],
];