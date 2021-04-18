<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
use Exception;

use App\Models\User;
use App\Models\Admin;
use App\Models\Button;
use App\Models\Link;
use App\Models\Page;

class AdminController extends Controller
{
    //Statistics of the number of clicks and links 
    public function index()
    {
        $userId = Auth::user()->id;
        $littlelink_name = Auth::user()->littlelink_name;
        $links = Link::where('user_id', $userId)->select('link')->count();
        $clicks = Link::where('user_id', $userId)->sum('click_number');
       
        $userNumber = User::count();
        $siteLinks = Link::count();
        $siteClicks = Link::sum('click_number');

        return view('panel/index', ['littlelink_name' => $littlelink_name, 'links' => $links, 'clicks' => $clicks, 'siteLinks' => $siteLinks, 'siteClicks' => $siteClicks, 'userNumber' => $userNumber]);
    }

    //Get users by type
    public function users(request $request)
    {
        $usersType = $request->type;

        switch($usersType){
            case 'all':
                $data['users'] = User::select('id', 'name', 'role', 'block')->get();
                return view('panel/users', $data);
                break;
            case 'user':
                $data['users'] = User::where('role', 'user')->select('id', 'name', 'role', 'block')->get();
                return view('panel/users', $data);
                break;
            case 'vip':
                $data['users'] = User::where('role', 'vip')->select('id', 'name', 'role', 'block')->get();
                return view('panel/users', $data);
                break;     
            case 'admin':
                $data['users'] = User::where('role', 'admin')->select('id', 'name', 'role', 'block')->get();
                return view('panel/users', $data);
                break;
            }
    }

    //Search user by name
    public function searchUser(request $request)
    {
        $name = $request->name;
        $data['users'] = User::where('name', $name)->select('id', 'name', 'role', 'block')->get();
        return view('panel/users', $data);
    }

    //Block user and delete their links
    public function blockUser(request $request)
    {
        $id = $request->id;
        $status = $request->block;

        if($status == 'yes'){
            $block = 'no';
        }elseif($status == 'no'){
            $block = 'yes';
        }

        User::where('id', $id)->update(['block' => $block]);

        Link::where('user_id', $id)->delete();

        return redirect('panel/users/all');
    }

    //Show user to edit
    public function showUser(request $request)
    {
        $id = $request->id;

        $data['user'] = User::where('id', $id)->get();
       
        return view('panel/edit-user', $data);

    }

    //Save user edit
    public function editUser(request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $profilePhoto = $request->file('image');
        $littlelink_name = $request->littlelink_name;
        $littlelink_description = $request->littlelink_description;
        $role = $request->role;
        
        User::where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password, 'littlelink_name' => $littlelink_name, 'littlelink_description' => $littlelink_description, 'role' => $role]);

        if(!empty($profilePhoto)){
        $profilePhoto->move(public_path('/img'), $littlelink_name . ".png");
        }

        return back();
    }

    //Show site pages to edit
    public function showSitePage()
    {
        $data['pages'] = Page::select('terms', 'privacy', 'contact')->get();
        return view('panel/pages', $data);
    }

    //Save site pages
    public function editSitePage(request $request)
    {
        $terms = $request->terms;
        $privacy = $request->privacy;
        $contact = $request->contact;

        Page::first()->update(['terms' => $terms, 'privacy' => $privacy, 'contact' => $contact]);

        return back();
    }

    //Show home message for edit
    public function showSite()
    {
        $message = Page::select('home_message')->first();
        return view('panel/site', $message);
    }

    //Save home message and logo
    public function editSite(request $request)
    {
        $message = $request->message;
        $logo = $request->file('image');

        Page::first()->update(['home_message' => $message]);

        if(!empty($logo)){
            $logo->move(public_path('/littlelink/images/'), "avatar.png");
            }

        return back();
    }

    //View any of the pages: contact, terms, privacy
    public function pages(request $request)
    {
        $name = $request->name;

        try {
            $data['page'] = Page::select($name)->first();
        } catch (Exception $e) {
            return abort(404);
        }

        return view('pages', ['data' => $data, 'name' => $name]);
    }
}
