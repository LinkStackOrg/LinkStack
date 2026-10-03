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

    $sanitizedText = sanitize_rich_text($request->text);

    // Prepare the link data
    $linkData = [
        'title' => $sanitizedText,
        'button_id' => "93", // Assuming '93' is a predefined ID for a "text" button
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}