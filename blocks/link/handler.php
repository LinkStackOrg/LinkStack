<?php

/**
 * Handles the logic for "link" link type.
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
    
    if ($request->GetSiteIcon == "1") {
        $buttonID = "2";
    } else {
        $buttonID = "1";
    }

    // Prepare the link data
    $linkData = [
        'title' => $request->title,
        'button_id' => $buttonID,
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}