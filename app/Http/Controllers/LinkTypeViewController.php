<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkType;
use App\Models\Link;
use App\Models\Button;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class LinkTypeViewController extends Controller
{
    public function getParamForm($typename, $linkId = 0)
    {
        $data = [
            'title' => '',
            'link' => '',
            'button_id' => 0,
            'buttons' => [],
        ];
    
        if ($linkId) {
            $link = Link::find($linkId);
            $data['title'] = $link->title;
            $data['link'] = $link->link;
            if (Route::currentRouteName() != 'showButtons') {
                $data['button_id'] = $link->button_id;
            }
    
            if (!empty($link->type_params) && is_string($link->type_params)) {
                $typeParams = json_decode($link->type_params, true);
                if (is_array($typeParams)) {
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
    
        // Set the block asset context before returning the view
        setBlockAssetContext($typename);
    
        return view($typename . '.form', $data);
    }

    public function blockAsset(Request $request, $type)
    {
        $asset = $request->query('asset');
    
        // Prevent directory traversal in $type
        if (preg_match('/\.\.|\/|\\\\/', $type)) {
            abort(403, 'Unauthorized action.');
        }
    
        // Define allowed file extensions
        $allowedExtensions = ['js', 'css', 'img', 'svg', 'gif', 'jpg', 'jpeg', 'png', 'mp4', 'mp3'];
    
        $extension = strtolower(pathinfo($asset, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            return response('File type not allowed', Response::HTTP_FORBIDDEN);
        }
    
        $basePath = realpath(base_path("blocks/$type"));
    
        $fullPath = realpath(base_path("blocks/$type/$asset"));
    
        if (!$fullPath || !file_exists($fullPath) || strpos($fullPath, $basePath) !== 0) {
            return response('File not found', Response::HTTP_NOT_FOUND);
        }
    
        // Map file extensions to MIME types
        $mimeTypes = [
            'js' => 'application/javascript',
            'css' => 'text/css',
            'img' => 'image/png',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'mp4' => 'video/mp4',
            'mp3' => 'audio/mpeg',
        ];
    
        // Determine the MIME type using the mapping
        $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';
    
        return response()->file($fullPath, [
            'Content-Type' => $mimeType
        ]);
    }
}