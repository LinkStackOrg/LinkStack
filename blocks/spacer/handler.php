<?php

/**
 * Handles the logic for "spacer" link type.
 * 
 * @param \Illuminate\Http\Request $request The incoming request.
 * @param mixed $linkType The link type information.
 * @return array The prepared link data.
 */
function handleLinkType($request, $linkType) {

    $rules = [
        'height' => [
            'required',
            'max:255',
        ],
    ];

    // Prepare the link data
    $linkData = [
        'title' => $request->height ?? null,
        'button_id' => "43",
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}