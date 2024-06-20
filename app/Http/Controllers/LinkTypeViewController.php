<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkType;
use App\Models\Link;
use App\Models\Button;
use Illuminate\Support\Facades\Route;

class LinkTypeViewController extends Controller
{
    public function getParamForm($typename, $linkId = 0)
    {
        $data = [
            'link_title' => '',
            'link_url' => '',
            'button_id' => 0,
            'buttons' => [],
        ];
    
        if ($linkId) {
            $link = Link::find($linkId);
            $typename = $link->type ?? 'predefined';
            $data['link_title'] = $link->title;
            $data['link_url'] = $link->link;
            if (Route::currentRouteName() != 'showButtons') {
                $data['button_id'] = $link->button_id;
            }
    
            // Check if type_params is not empty and is a valid JSON string
            if (!empty($link->type_params) && is_string($link->type_params)) {
                // Decode the JSON string into an associative array
                $typeParams = json_decode($link->type_params, true);
                if (is_array($typeParams)) {
                    // Merge the associative array into $data
                    $data = array_merge($data, $typeParams);
                }
            }
        }
        if ($typename === 'predefined') {
            $buttons = Button::select()->orderBy('name', 'asc')->get();
            foreach ($buttons as $btn) {
                $data['buttons'][] = [
                    'name' => $btn->name,
                    'title' => $btn->alt,
                    'exclude' => $btn->exclude,
                    'selected' => ($linkId && isset($link) && $link->button_id == $btn->id),
                ];
            }
            return view('components.pageitems.predefined-form', $data);
        }
    
        return view($typename . '.form', $data);
    }
}