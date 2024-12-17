<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class HomeController extends Controller
{
    //Show home message, number of buttons and updated pages
    public function home()
    {

        $message = Page::select('home_message')->first();

        return view('home', ['message' => $message]);
    }

    // Show demo page
    public function demo(request $request)
    {
        $message = Page::select('home_message')->first();

        return view('demo', ['message' => $message]);
    }

}
