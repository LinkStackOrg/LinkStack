<?php

/**
 * Handles the logic for "vcard" link type.
 * 
 * @param \Illuminate\Http\Request $request The incoming request.
 * @param mixed $linkType The link type information.
 * @return array The prepared link data.
 */
function handleLinkType($request, $linkType) {

    $rules = [];

    // Extract the necessary data from the request
    $data = $request->only([
        'prefix', 'first_name', 'middle_name', 'last_name', 'suffix',
        'organization', 'vtitle', 'role', 'work_url', 'email', 'work_email',
        'home_phone', 'work_phone', 'cell_phone', 'home_address_label', 'home_address_street',
        'home_address_city', 'home_address_state', 'home_address_zip', 'home_address_country',
        'work_address_label', 'work_address_street', 'work_address_city', 'work_address_state',
        'work_address_zip', 'work_address_country'
    ]);

    // Prepare the link data
    $linkData = [
        'title' => $request->link_title,
        'link' => json_encode($data), // Encode the vCard data as JSON
        'button_id' => "96",
    ];

    return ['rules' => $rules, 'linkData' => $linkData];
}