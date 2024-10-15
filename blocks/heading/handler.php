<?php

/**
 * Handles the logic for "heading" link type.
 * 
 * @param \Illuminate\Http\Request $request The incoming request.
 * @param mixed $linkType The link type information.
 * @return array The prepared link data.
 */
function handleLinkType($request, $linkType) {

    $rules = [
        'title' => [
            'required',
            'string',
            'max:255',
        ],
    ];

    // Prepare the link data
    $linkData = [
        'title' => $request->title,
        'button_id' => "42",
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}