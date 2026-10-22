<?php

/**
 * Handles the logic for "text" link type.
 * 
 * @param \Illuminate\Http\Request $request The incoming request.
 * @param mixed $linkType The link type information.
 * @return array The prepared link data.
 */
function handleLinkType($request, $linkType) {

    $rules = [
        'text' => [
            'required',
            'string',
            'max:5000',
        ],
    ];

    // Sanitize the text input
    $sanitizedText = $request->text;
    $sanitizedText = strip_tags($sanitizedText, '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
    $sanitizedText = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $sanitizedText);
    
    // Assuming strip_tags_except_allowed_protocols is a custom function defined elsewhere
    // This function should sanitize the text further by removing all tags except those allowed
    // and ensuring all protocols in href attributes are safe.
    $sanitizedText = strip_tags_except_allowed_protocols($sanitizedText);

    // Prepare the link data
    $linkData = [
        'title' => $sanitizedText,
        'button_id' => "93", // Assuming '93' is a predefined ID for a "text" button
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}