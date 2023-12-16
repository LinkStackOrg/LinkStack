<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;


use App\Models\LinkType;
use App\Models\Link;

use App\Models\Button;
use micro\FormFactory;

use DB;

class LinkTypeViewController extends Controller
{


    public function getParamForm($typeid, $linkId = 0)
    {
        $linkType = LinkType::select('params', 'typename')->where('id', $typeid)->First();


        $data['params'] = '';
        $data['link_title'] = '';
        $data['link_url'] = '';
        $data['button_id'] = 0;

        if ($linkId) {
            $link = Link::find($linkId);
            $data['params'] = json_decode($link['type_params']);
            $data['link_title'] = $link->title;
            $data['link_url'] = $link->link;
            if (Route::currentRouteName() != 'showButtons') {$data['button_id'] = $link->button_id;}
        }

        if (!empty($linkType) && $linkType->typename === 'predefined') {
            // get buttons list if showing predefined form
            $buttons = Button::select()->orderBy('name', 'asc')->get();
            foreach ($buttons as $btn) {
                $data['buttons'][] = [
                    'name' => $btn->name,
                    'title' => $btn->alt,
                    'exclude' => $btn->exclude,
                    'selected' => (is_object($data['params']) && $data['params']->button === $btn->name)
                ];
            }
//echo "<pre>"; print_r($data['params']); exit;

        }
        return view('components.pageitems.'. $linkType->typename.'-form', $data);

        $jsonForm = FormFactory::jsonForm();
        try {
            $json = $linkType->params;
        } catch (\Throwable $th) {
            //throw $th;
        }


        // dynamiclly create params for predefined website to fill a select list with available buttons
        if (!empty($linkType) && $linkType->typename === 'predefined') {
            $buttons = Button::select('name')->orderBy('name', 'asc')->get();
           $pdParams[] = ['tag' => 'select', 'name' => 'button', 'id'=> 'button'];
            foreach ($buttons as $btn) {
                $pdParams[0]['value'][] = [
                    'tag'=>'option',
                    'label' => ucwords($btn->name),
                    'value' => $btn->name
                ];

            }
            $pdParams[] = ['tag' => 'input', 'name' => 'link_title', 'id' => 'link_title', 'name' => 'link_title', 'tip' => 'Leave blank for default title'];
            $pdParams[] = ['tag' => 'input', 'name' => 'link_url', 'id' => 'link_url', 'name' => 'link_url', 'tip' => 'Enter the url address for this site.'];

            $json = json_encode($pdParams);
        }

        if (empty($json)) {
            $json =
                <<<EOS
            [{
                "tag": "input",
                "id": "link_title",
                "for": "link_title",
                "label": "Link Title *",
                "type": "text",
                "name": "link_title",
                "class": "form-control",
                "tip": "Enter a title for this link",
                "required": "required"
            },
            {
                "tag": "input",
                "id": "link",
                "for": "link",
                "label": "Link Address *",
                "type": "text",
                "name": "link_title",
                "class": "form-control",
                "tip": "Enter the website address",
                "required": "required"
            }
            ]
            EOS;
        }


        if ($linkId) {

            $link = Link::find($linkId);
        }


        // cleanup json
        $params = json_decode($json, true);
        $idx = 0;
        foreach ($params as $p) {
            if (!array_key_exists('for', $p))
                $params[$idx]['for'] = $p['name'];

            if (!array_key_exists('label', $p))
                $params[$idx]['label'] = ucwords(preg_replace('/[^a-zA-Z0-9-]/', ' ', $p['name']));

            if (!array_key_exists('label', $p) || !str_contains($p['class'], 'form-control')) {
                $params[$idx]['class'] = " form-control";
            }

            // get existing values if any
            if ($link) {
                $typeParams = json_decode($link['type_params']);


 //echo "<pre>";
//  print_r($typeParams);
                  //print_r($params[$idx]);
                 //echo "</pre>";

                if ($typeParams && property_exists($typeParams, $params[$idx]['name'])) {
                    if (key_exists('value', $params[$idx]) && is_array($params[$idx]['value'])) {

                        $optIdx = 0;
                        foreach ($params[$idx]['value'] as $option) {
                            //echo $option['value']."<br />";
                            //echo $typeParams->{$params[$idx]['name']};
                            if ($option['value'] == $typeParams->{$params[$idx]['name']}) {
                                $params[$idx]['value'][$optIdx]['selected'] = true;
                                break;
                            }
                            //echo $key ." = ".$value;
                            $optIdx++;
                        }
                    } else {
                        $params[$idx]['value'] = $typeParams->{$params[$idx]['name']};
                    }
                }

            }

            $idx++;
        }
        $json = json_encode($params);


        echo $jsonForm->render($json);
    }
}
