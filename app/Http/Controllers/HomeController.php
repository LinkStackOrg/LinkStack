<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Models\Page;
use App\Models\Button;

class HomeController extends Controller
{
    //Show home message, number of buttons and updated pages
    public function home()
    {

        $message = Page::select('home_message')->first();
       
        $countButton = Button::count();

        $updatedPages = DB::table('links')->join('users', 'users.id', '=', 'links.user_id')->select('users.arcanelink_name', DB::raw('max(links.created_at) as created_at'))->groupBy('links.user_id')->orderBy('created_at', 'desc')->take(4)->get();

        return view('home', ['message' => $message, 'countButton' => $countButton, 'updatedPages' => $updatedPages]);
    }

}
