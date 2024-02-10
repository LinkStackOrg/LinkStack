<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Cohensive\OEmbed\Facades\OEmbed;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use JeroenDesloovere\VCard\VCard;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportSubmissionMail;
use GeoSot\EnvEditor\Facades\EnvEditor;

use Auth;
use DB;
use ZipArchive;
use File;

use App\Models\User;
use App\Models\Button;
use App\Models\Link;
use App\Models\LinkType;
use App\Models\UserData;


//Function tests if string starts with certain string (used to test for illegal strings)
function stringStartsWith($haystack, $needle, $case = true)
{
    if ($case) {
        return strpos($haystack, $needle, 0) === 0;
    }
    return stripos($haystack, $needle, 0) === 0;
}

//Function tests if string ends with certain string (used to test for illegal strings)
function stringEndsWith($haystack, $needle, $case = true)
{
    $expectedPosition = strlen($haystack) - strlen($needle);
    if ($case) {
        return strrpos($haystack, $needle, 0) === $expectedPosition;
    }
    return strripos($haystack, $needle, 0) === $expectedPosition;
}

class UserController extends Controller
{

    //Statistics of the number of clicks and links
    public function index()
    {
        $userId = Auth::user()->id;

        $littlelink_name = Auth::user()->littlelink_name;
        $userinfo = User::find($userId);

        $links = Link::where('user_id', $userId)->select('link')->count();
        $clicks = Link::where('user_id', $userId)->sum('click_number');
        $topLinks = Link::where('user_id', $userId)->orderby('click_number', 'desc')
            ->whereNotNull('link')->where('link', '<>', '')
            ->take(5)->get();

        $pageStats = [
            'visitors' => [
                'all' => visits('App\Models\User', $littlelink_name)->count(),
                'day' => visits('App\Models\User', $littlelink_name)->period('day')->count(),
                'week' => visits('App\Models\User', $littlelink_name)->period('week')->count(),
                'month' => visits('App\Models\User', $littlelink_name)->period('month')->count(),
                'year' => visits('App\Models\User', $littlelink_name)->period('year')->count(),
            ],
            'os' => visits('App\Models\User', $littlelink_name)->operatingSystems(),
            'referers' => visits('App\Models\User', $littlelink_name)->refs(),
            'countries' => visits('App\Models\User', $littlelink_name)->countries(),
        ];



        return view('studio/index', ['greeting' => $userinfo->name, 'toplinks' => $topLinks, 'links' => $links, 'clicks' => $clicks, 'pageStats' => $pageStats]);
    }

    //Show littlelink page. example => http://127.0.0.1:8000/+admin
    public function littlelink(request $request)
    {
        if(isset($request->useif)){
            $littlelink_name = User::select('littlelink_name')->where('id', $request->littlelink)->value('littlelink_name');
            $id = $request->littlelink;
        } else {
            $littlelink_name = $request->littlelink;
            $id = User::select('id')->where('littlelink_name', $littlelink_name)->value('id');
        }

        if (empty($id)) {
            return abort(404);
        }
     
        $userinfo = User::select('id', 'name', 'littlelink_name', 'littlelink_description', 'theme', 'role', 'block')->where('id', $id)->first();
        $information = User::select('name', 'littlelink_name', 'littlelink_description', 'theme')->where('id', $id)->get();
        
        if ($userinfo->block == 'yes') {
            return abort(404);
        }
        
        $links = DB::table('links')->join('buttons', 'buttons.id', '=', 'links.button_id')->select('links.link', 'links.id', 'links.button_id', 'links.title', 'links.custom_css', 'links.custom_icon', 'buttons.name')->where('user_id', $id)->orderBy('up_link', 'asc')->orderBy('order', 'asc')->get();

        return view('linkstack.linkstack', ['userinfo' => $userinfo, 'information' => $information, 'links' => $links, 'littlelink_name' => $littlelink_name]);
    }

    //Show littlelink page as home page if set in config
    public function littlelinkhome(request $request)
    {
        $littlelink_name = env('HOME_URL');
        $id = User::select('id')->where('littlelink_name', $littlelink_name)->value('id');

        if (empty($id)) {
            return abort(404);
        }
     
        $userinfo = User::select('id', 'name', 'littlelink_name', 'littlelink_description', 'theme', 'role', 'block')->where('id', $id)->first();
        $information = User::select('name', 'littlelink_name', 'littlelink_description', 'theme')->where('id', $id)->get();
        
        $links = DB::table('links')->join('buttons', 'buttons.id', '=', 'links.button_id')->select('links.link', 'links.id', 'links.button_id', 'links.title', 'links.custom_css', 'links.custom_icon', 'buttons.name')->where('user_id', $id)->orderBy('up_link', 'asc')->orderBy('order', 'asc')->get();

        return view('linkstack.linkstack', ['userinfo' => $userinfo, 'information' => $information, 'links' => $links, 'littlelink_name' => $littlelink_name]);
    }

    //Redirect to user page
    public function userRedirect(request $request)
    {
        $id = $request->id;
        $user = User::select('littlelink_name')->where('id', $id)->value('littlelink_name');

        if (empty($id)) {
            return abort(404);
        }
     
        if (empty($user)) {
            return abort(404);
        }

        return redirect(url('@'.$user));
    }

    //Show add/update form
    public function AddUpdateLink($id = 0)
    {

        if ($id !== 0) {
            $linkData = Link::find($id);
        } elseif ($id == 0) {
            $linkData = new Link(['typename' => 'link', 'id'=>'0']);
        } else {
            $linkData = new Link(['typename' => 'link', 'id'=>'0']);
        }
        $data['LinkTypes'] = LinkType::get();
        $data['LinkData'] = $linkData;
        $data['LinkID'] = $id;
        $data['linkTypeID'] = "1";
        $data['title'] = "Predefined Site";

        if (Route::currentRouteName() != 'showButtons') {
            $links = DB::table('links')->where('id', $id)->first();

            $bid = $links->button_id;

            if($bid == 1 or $bid == 2){
                $data['linkTypeID'] = "2";
            } elseif ($bid == 42) {
                $data['linkTypeID'] = "3";
            } elseif ($bid == 43) {
                $data['linkTypeID'] = "4";
            } elseif ($bid == 93) {
                $data['linkTypeID'] = "5";
            } elseif ($bid == 6 or $bid == 7) {
                $data['linkTypeID'] = "6";
            } elseif ($bid == 44) {
                $data['linkTypeID'] = "7";
            } elseif ($bid == 96) {
                $data['linkTypeID'] = "8";
            } else {
                $data['linkTypeID'] = "1";
            }

            $data['title'] = LinkType::where('id', $data['linkTypeID'])->value('title');
        }

        foreach ($data['LinkTypes']->toArray() as $key => $val) {
            if ($val['typename'] === $linkData['typename']) {
                $data['SelectedLinkType'] = $val;
                break;
            }
        }
        
        return view('studio/edit-link', $data);
    }

    //Save add link
    public function saveLink(request $request)
    {
        $request->validate([
            'link' => 'sometimes|exturl',
        ]);

        $linkType = LinkType::find($request->linktype_id);
        $LinkTitle = ($request->link_text ?? $request->link_title) ?? $request->title;
        $LinkURL = $request->link_url ?? $request->link;

        $OrigLink = Link::find($request->linkid);

        $customParams = [];
        foreach ($request->all() as $key => $param) {
            //echo $key . " = " . $param . "<br />";
            if (str_starts_with($key, "_") ||  in_array($key, ['linktype_id', 'linktype_title', 'link_text', 'link_url']))
                continue;

            $customParams[$key] = $param;
        }

        $userId = Auth::user()->id;
        $button = Button::where('name', $request->button)->first();

        if ($button && empty($LinkTitle))
            $LinkTitle = $button->alt;

        if ($linkType->typename == 'video' && empty($LinkTitle)) {
            $embed = OEmbed::get($LinkURL);
            if ($embed) {
                $LinkTitle = $embed->data()['title'];
            }
        }

        $message = (ucwords($button?->name) ?? ucwords($linkType->typename)). " has been ";

        if ($OrigLink) {
            //EDITING EXISTING

            $isCustomWebsite = $customParams['GetSiteIcon'] ?? null;
            $SpacerHeight = $customParams['height'] ?? null;

                if($linkType->typename == "link" and $isCustomWebsite == "1"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'title' => $LinkTitle,
                        'button_id' => "2",
                    ]);
                }elseif($linkType->typename == "link"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'title' => $LinkTitle,
                        'button_id' => "1",
                    ]);
                }elseif($linkType->typename == "spacer"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'title' => $customParams['height'] ?? null,
                        'button_id' => "43",
                    ]);
                }elseif($linkType->typename == "heading"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'title' => $LinkTitle,
                        'button_id' => "42",
                    ]);
                }elseif($linkType->typename == "text"){
                    $sanitizedText = $request->text;
                    $sanitizedText = strip_tags($sanitizedText, '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
                    $sanitizedText = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $sanitizedText);
                    $sanitizedText = strip_tags_except_allowed_protocols($sanitizedText);
                    $OrigLink->update([
                        'button_id' => "93",
                        'title' => $sanitizedText,
                    ]);
                }elseif($linkType->typename == "email"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'button_id' => $button?->id,
                        'title' => $LinkTitle,
                    ]);
                }elseif($linkType->typename == "telephone"){
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'button_id' => $button?->id,
                        'title' => $LinkTitle,
                    ]);
                }elseif($linkType->typename == "vcard"){

                    $prefix = $request->input('prefix');
                    $firstName = $request->input('first_name');
                    $middleName = $request->input('middle_name');
                    $lastName = $request->input('last_name');
                    $suffix = $request->input('suffix');
                    $nickname = $request->input('nickname');
                    $organization = $request->input('organization');
                    $vtitle = $request->input('vtitle');
                    $role = $request->input('role');
                    $workUrl = $request->input('work_url');
                    $email = $request->input('email');
                    $workEmail = $request->input('work_email');
                    $homePhone = $request->input('home_phone');
                    $workPhone = $request->input('work_phone');
                    $cellPhone = $request->input('cell_phone');
                    $homeAddressLabel = $request->input('home_address_label');
                    $homeAddressStreet = $request->input('home_address_street');
                    $homeAddressCity = $request->input('home_address_city');
                    $homeAddressState = $request->input('home_address_state');
                    $homeAddressZip = $request->input('home_address_zip');
                    $homeAddressCountry = $request->input('home_address_country');
                    $workAddressLabel = $request->input('work_address_label');
                    $workAddressStreet = $request->input('work_address_street');
                    $workAddressCity = $request->input('work_address_city');
                    $workAddressState = $request->input('work_address_state');
                    $workAddressZip = $request->input('work_address_zip');
                    $workAddressCountry = $request->input('work_address_country');
    
                    // Create an array with all the input fields
                    $data = [
                        'prefix' => $request->input('prefix'),
                        'first_name' => $request->input('first_name'),
                        'middle_name' => $request->input('middle_name'),
                        'last_name' => $request->input('last_name'),
                        'suffix' => $request->input('suffix'),
                        'nickname' => $request->input('nickname'),
                        'organization' => $request->input('organization'),
                        'vtitle' => $request->input('vtitle'),
                        'role' => $request->input('role'),
                        'work_url' => $request->input('work_url'),
                        'email' => $request->input('email'),
                        'work_email' => $request->input('work_email'),
                        'home_phone' => $request->input('home_phone'),
                        'work_phone' => $request->input('work_phone'),
                        'cell_phone' => $request->input('cell_phone'),
                        'home_address_label' => $request->input('home_address_label'),
                        'home_address_street' => $request->input('home_address_street'),
                        'home_address_city' => $request->input('home_address_city'),
                        'home_address_state' => $request->input('home_address_state'),
                        'home_address_zip' => $request->input('home_address_zip'),
                        'home_address_country' => $request->input('home_address_country'),
                        'work_address_label' => $request->input('work_address_label'),
                        'work_address_street' => $request->input('work_address_street'),
                        'work_address_city' => $request->input('work_address_city'),
                        'work_address_state' => $request->input('work_address_state'),
                        'work_address_zip' => $request->input('work_address_zip'),
                        'work_address_country' => $request->input('work_address_country'),
                    ];
                    
                    // Convert the array to JSON format
                    $json = json_encode($data);
                    
                    // Set the JSON as the variable $links->link, or null if the JSON is empty
                    $LinkURL = $json ? $json : null;        

                    $OrigLink->update([
                        'link' => $LinkURL,
                        'button_id' => 96,
                        'title' => $LinkTitle,
                    ]);
                }else{
                    $OrigLink->update([
                        'link' => $LinkURL,
                        'title' => $LinkTitle,
                        'button_id' => $button?->id,
                    ]);
                }
                
            $message .="updated";

        } else {
            // ADDING NEW

            $isCustomWebsite = $customParams['GetSiteIcon'] ?? null;
            $SpacerHeight = $customParams['height'] ?? null;
            
            $links = new Link;
            $links->link = $LinkURL;
            $links->user_id = $userId;
            if($linkType->typename == "spacer"){
            $links->title = $SpacerHeight;
            }else{
            $links->title = $LinkTitle;
            }
            if($linkType->typename == "link" and $isCustomWebsite == "1"){
                $links->button_id = "2";
            }elseif($linkType->typename == "link"){
                $links->button_id = "1";
            }elseif($linkType->typename == "spacer"){
                $links->button_id = "43";
            }elseif($linkType->typename == "heading"){
                $links->button_id = "42";
            }elseif($linkType->typename == "text"){
                $sanitizedText = $request->text;
                $sanitizedText = strip_tags($sanitizedText, '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
                $sanitizedText = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $sanitizedText);
                $sanitizedText = strip_tags_except_allowed_protocols($sanitizedText);
                $links->button_id = "93";
                $links->title = $sanitizedText;
            }elseif($linkType->typename == "email"){
                $links->button_id = $button?->id;
            }elseif($linkType->typename == "telephone"){
                $links->button_id = $button?->id;
            }elseif($linkType->typename == "vcard"){

                $prefix = $request->input('prefix');
                $firstName = $request->input('first_name');
                $middleName = $request->input('middle_name');
                $lastName = $request->input('last_name');
                $suffix = $request->input('suffix');
                $nickname = $request->input('nickname');
                $organization = $request->input('organization');
                $vtitle = $request->input('vtitle');
                $role = $request->input('role');
                $workUrl = $request->input('work_url');
                $email = $request->input('email');
                $workEmail = $request->input('work_email');
                $homePhone = $request->input('home_phone');
                $workPhone = $request->input('work_phone');
                $cellPhone = $request->input('cell_phone');
                $homeAddressLabel = $request->input('home_address_label');
                $homeAddressStreet = $request->input('home_address_street');
                $homeAddressCity = $request->input('home_address_city');
                $homeAddressState = $request->input('home_address_state');
                $homeAddressZip = $request->input('home_address_zip');
                $homeAddressCountry = $request->input('home_address_country');
                $workAddressLabel = $request->input('work_address_label');
                $workAddressStreet = $request->input('work_address_street');
                $workAddressCity = $request->input('work_address_city');
                $workAddressState = $request->input('work_address_state');
                $workAddressZip = $request->input('work_address_zip');
                $workAddressCountry = $request->input('work_address_country');

                // Create an array with all the input fields
                $data = [
                    'prefix' => $request->input('prefix'),
                    'first_name' => $request->input('first_name'),
                    'middle_name' => $request->input('middle_name'),
                    'last_name' => $request->input('last_name'),
                    'suffix' => $request->input('suffix'),
                    'nickname' => $request->input('nickname'),
                    'organization' => $request->input('organization'),
                    'vtitle' => $request->input('vtitle'),
                    'role' => $request->input('role'),
                    'work_url' => $request->input('work_url'),
                    'email' => $request->input('email'),
                    'work_email' => $request->input('work_email'),
                    'home_phone' => $request->input('home_phone'),
                    'work_phone' => $request->input('work_phone'),
                    'cell_phone' => $request->input('cell_phone'),
                    'home_address_label' => $request->input('home_address_label'),
                    'home_address_street' => $request->input('home_address_street'),
                    'home_address_city' => $request->input('home_address_city'),
                    'home_address_state' => $request->input('home_address_state'),
                    'home_address_zip' => $request->input('home_address_zip'),
                    'home_address_country' => $request->input('home_address_country'),
                    'work_address_label' => $request->input('work_address_label'),
                    'work_address_street' => $request->input('work_address_street'),
                    'work_address_city' => $request->input('work_address_city'),
                    'work_address_state' => $request->input('work_address_state'),
                    'work_address_zip' => $request->input('work_address_zip'),
                    'work_address_country' => $request->input('work_address_country'),
                ];
                
                // Convert the array to JSON format
                $json = json_encode($data);
                
                // Set the JSON as the variable $links->link, or null if the JSON is empty
                $links->link = $json ? $json : null;               

                $links->button_id = 96;
            }else{
                $links->button_id = $button?->id;
            }

            if(empty($links->button_id)) {
                throw new \Exception('Invalid link');
            }
            
            $links->save();

            $links->order = ($links->id - 1);
            $links->save();
            $message .= "added";
        }

            if ($request->input('param') == 'add_more') {
                return Redirect('studio/add-link')
                ->with('success', $message);
            } else {
                return Redirect('studio/links')
                ->with('success', $message);
            }

    }

    public function sortLinks(Request $request)
    {
        $linkOrders  = $request->input("linkOrders", []);
        $currentPage = $request->input("currentPage", 1);
        $perPage     = $request->input("perPage", 0);

        if ($perPage == 0) {
            $currentPage = 1;
        }

        $linkOrders = array_unique(array_filter($linkOrders));
        if (!$linkOrders || $currentPage < 1) {
            return response()->json([
                'status' => 'ERROR',
            ]);
        }

        $newOrder = $perPage * ($currentPage - 1);
        $linkNewOrders = [];
        foreach ($linkOrders as $linkId) {
            if ($linkId < 0) {
                continue;
            }

            $linkNewOrders[$linkId] = $newOrder;
            Link::where("id", $linkId)
                ->update([
                    'order' => $newOrder
                ]);
            $newOrder++;
        }

        return response()->json([
            'status' => 'OK',
            'linkOrders' => $linkNewOrders,
        ]);
    }


    //Count the number of clicks and redirect to link
    public function clickNumber(request $request)
    {
        $linkId = $request->id;

        if (substr($linkId, -1) == '+') {
            $linkWithoutPlus = str_replace('+', '', $linkId);
            return redirect(url('info/'.$linkWithoutPlus));
        }
    
        $link = Link::find($linkId);

        if (empty($link)) {
            return abort(404);
        }

        $link = $link->link;

        if (empty($linkId)) {
            return abort(404);
        }

        Link::where('id', $linkId)->increment('click_number', 1);

        $response = redirect()->away($link);
        $response->header('X-Robots-Tag', 'noindex, nofollow');

        return $response;
    }

    //Download Vcard
    public function vcard(request $request)
    {
        $linkId = $request->id;

        // Find the link with the specified ID
        $link = Link::findOrFail($linkId);

        $json = $link->link;

        // Decode the JSON to a PHP array
        $data = json_decode($json, true);
        
        // Create a new vCard object
        $vcard = new VCard();
        
        // Set the vCard properties from the $data array
        $vcard->addName($data['last_name'], $data['first_name'], $data['middle_name'], $data['prefix'], $data['suffix']);
        $vcard->addCompany($data['organization']);
        $vcard->addJobtitle($data['vtitle']);
        $vcard->addRole($data['role']);
        $vcard->addEmail($data['email']);
        $vcard->addEmail($data['work_email'], 'WORK');
        $vcard->addURL($data['work_url'], 'WORK');
        $vcard->addPhoneNumber($data['home_phone'], 'HOME');
        $vcard->addPhoneNumber($data['work_phone'], 'WORK');
        $vcard->addPhoneNumber($data['cell_phone'], 'CELL');
        $vcard->addAddress($data['home_address_street'], '', $data['home_address_city'], $data['home_address_state'], $data['home_address_zip'], $data['home_address_country'], 'HOME');
        $vcard->addAddress($data['work_address_street'], '', $data['work_address_city'], $data['work_address_state'], $data['work_address_zip'], $data['work_address_country'], 'WORK');
        

        // $vcard->addPhoto(base_path('img/1.png'));
        
        // Generate the vCard file contents
        $file_contents = $vcard->getOutput();
        
        // Set the file headers for download
        $headers = [
            'Content-Type' => 'text/x-vcard',
            'Content-Disposition' => 'attachment; filename="contact.vcf"'
        ];
        
        Link::where('id', $linkId)->increment('click_number', 1);

        // Return the file download response
        return response()->make($file_contents, 200, $headers);

    }

    //Show link, click number, up link in links page
    public function showLinks()
    {
        $userId = Auth::user()->id;
        $data['pagePage'] = 10;
        
        $data['links'] = Link::select('id', 'link', 'title', 'order', 'click_number', 'up_link', 'links.button_id')->where('user_id', $userId)->orderBy('up_link', 'asc')->orderBy('order', 'asc')->paginate(99999);
        return view('studio/links', $data);
    }

    //Delete link
    public function deleteLink(request $request)
    {
        $linkId = $request->id;

        Link::where('id', $linkId)->delete();

        $directory = base_path("assets/favicon/icons");
        $files = scandir($directory);
        foreach($files as $file) {
        if (strpos($file, $linkId.".") !== false) {
        $pathinfo = pathinfo($file, PATHINFO_EXTENSION);}}
        if (isset($pathinfo)) {
        try{File::delete(base_path("assets/favicon/icons")."/".$linkId.".".$pathinfo);} catch (exception $e) {}
        }

        return redirect('/studio/links');
    }

    //Delete icon
    public function clearIcon(request $request)
    {
        $linkId = $request->id;

        $directory = base_path("assets/favicon/icons");
        $files = scandir($directory);
        foreach($files as $file) {
        if (strpos($file, $linkId.".") !== false) {
        $pathinfo = pathinfo($file, PATHINFO_EXTENSION);}}
        if (isset($pathinfo)) {
        try{File::delete(base_path("assets/favicon/icons")."/".$linkId.".".$pathinfo);} catch (exception $e) {}
        }

        return redirect('/studio/links');
    }

    //Raise link on the littlelink page
    public function upLink(request $request)
    {
        $linkId = $request->id;
        $upLink = $request->up;

        if ($upLink == 'yes') {
            $up = 'no';
        } elseif ($upLink == 'no') {
            $up = 'yes';
        }

        Link::where('id', $linkId)->update(['up_link' => $up]);

        return back();
    }

    //Show link to edit
    public function showLink(request $request)
    {
        $linkId = $request->id;

        $link = Link::where('id', $linkId)->value('link');
        $title = Link::where('id', $linkId)->value('title');
        $order = Link::where('id', $linkId)->value('order');
        $custom_css = Link::where('id', $linkId)->value('custom_css');
        $buttonId = Link::where('id', $linkId)->value('button_id');
        $buttonName = Button::where('id', $buttonId)->value('name');

        $buttons = Button::select('id', 'name')->orderBy('name', 'asc')->get();

        return view('studio/edit-link', ['custom_css' => $custom_css, 'buttonId' => $buttonId, 'buttons' => $buttons, 'link' => $link, 'title' => $title, 'order' => $order, 'id' => $linkId, 'buttonName' => $buttonName]);
    }

    //Show custom CSS + custom icon
    public function showCSS(request $request)
    {
        $linkId = $request->id;

        $link = Link::where('id', $linkId)->value('link');
        $title = Link::where('id', $linkId)->value('title');
        $order = Link::where('id', $linkId)->value('order');
        $custom_css = Link::where('id', $linkId)->value('custom_css');
        $custom_icon = Link::where('id', $linkId)->value('custom_icon');
        $buttonId = Link::where('id', $linkId)->value('button_id');

        $buttons = Button::select('id', 'name')->get();

        return view('studio/button-editor', ['custom_icon' => $custom_icon, 'custom_css' => $custom_css, 'buttonId' => $buttonId, 'buttons' => $buttons, 'link' => $link, 'title' => $title, 'order' => $order, 'id' => $linkId]);
    }

    //Save edit link
    public function editLink(request $request)
    {
        $request->validate([
            'link' => 'required|exturl',
            'title' => 'required',
            'button' => 'required',
        ]);

        if (stringStartsWith($request->link, 'http://') == 'true' or stringStartsWith($request->link, 'https://') == 'true' or stringStartsWith($request->link, 'mailto:') == 'true')
            $link1 = $request->link;
        else
            $link1 = 'https://' . $request->link;
        if (stringEndsWith($request->link, '/') == 'true')
            $link = rtrim($link1, "/ ");
        else
        $link = $link1;
        $title = $request->title;
        $order = $request->order;
        $button = $request->button;
        $linkId = $request->id;

        $buttonId = Button::select('id')->where('name', $button)->value('id');

        Link::where('id', $linkId)->update(['link' => $link, 'title' => $title, 'order' => $order, 'button_id' => $buttonId]);

        return redirect('/studio/links');
    }

    //Save edit custom CSS + custom icon
    public function editCSS(request $request)
    {
        $linkId = $request->id;
        $custom_icon = $request->custom_icon;
        $custom_css = $request->custom_css;

        if ($request->custom_css == "" and $request->custom_icon = !"") {
            Link::where('id', $linkId)->update(['custom_icon' => $custom_icon]);
        } elseif ($request->custom_icon == "" and $request->custom_css = !"") {
            Link::where('id', $linkId)->update(['custom_css' => $custom_css]);
        } else {
            Link::where('id', $linkId)->update([]);
        }
        return Redirect('#result');
    }

    //Show littlelinke page for edit
    public function showPage(request $request)
    {
        $userId = Auth::user()->id;

        $data['pages'] = User::where('id', $userId)->select('littlelink_name', 'littlelink_description', 'image', 'name')->get();

        return view('/studio/page', $data);
    }

    //Save littlelink page (name, description, logo)
    public function editPage(Request $request)
    {
        $userId = Auth::user()->id;
        $littlelink_name = Auth::user()->littlelink_name;
    
        $validator = Validator::make($request->all(), [
            'littlelink_name' => [
                'sometimes',
                'max:255',
                'string',
                'isunique:users,id,'.$userId,
            ],
            'name' => 'sometimes|max:255|string',
            'image' => 'sometimes|image|mimes:jpeg,jpg,png,webp|max:2048', // Max file size: 2MB
        ], [
            'littlelink_name.unique' => __('messages.That handle has already been taken'),
            'image.image' => __('messages.The selected file must be an image'),
            'image.mimes' => __('messages.The image must be') . ' JPEG, JPG, PNG, webP.',
            'image.max' => __('messages.The image size should not exceed 2MB'),
        ]);
    
        if ($validator->fails()) {
            return redirect('/studio/page')->withErrors($validator)->withInput();
        }
    
        $profilePhoto = $request->file('image');
        $pageName = $request->littlelink_name;
        $pageDescription = strip_tags($request->pageDescription, '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
        $pageDescription = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $pageDescription);
        $pageDescription = strip_tags_except_allowed_protocols($pageDescription);
        $name = $request->name;
        $checkmark = $request->checkmark;
        $sharebtn = $request->sharebtn;
        $tablinks = $request->tablinks;

        if(env('HOME_URL') !== '' && $pageName != $littlelink_name && $littlelink_name == env('HOME_URL')){
            EnvEditor::editKey('HOME_URL', $pageName);
        }
    
        User::where('id', $userId)->update([
            'littlelink_name' => $pageName,
            'littlelink_description' => $pageDescription,
            'name' => $name
        ]);
    
        if ($request->hasFile('image')) {

            // Delete the user's current avatar if it exists
            while (findAvatar($userId) !== "error.error") {
                $avatarName = findAvatar($userId);
                unlink(base_path($avatarName));
            }
            
            $fileName = $userId . '_' . time() . "." . $profilePhoto->extension();
            $profilePhoto->move(base_path('assets/img'), $fileName);
        }
    
        if ($checkmark == "on") {
            UserData::saveData($userId, 'checkmark', true);
        } else {
            UserData::saveData($userId, 'checkmark', false);
        }
    
        if ($sharebtn == "on") {
            UserData::saveData($userId, 'disable-sharebtn', false);
        } else {
            UserData::saveData($userId, 'disable-sharebtn', true);
        }

        if ($tablinks == "on") {
            UserData::saveData($userId, 'links-new-tab', true);
        } else {
            UserData::saveData($userId, 'links-new-tab', false);
        }
    
        return Redirect('/studio/page');
    }

    //Upload custom theme background image
    public function themeBackground(Request $request)
    {
        $userId = Auth::user()->id;
        $littlelink_name = Auth::user()->littlelink_name;
    
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png,webp,gif|max:2048', // Max file size: 2MB
        ], [
            'image.required' => __('messages.Please select an image'),
            'image.image' => __('messages.The selected file must be an image'),
            'image.mimes' => __('messages.The image must be') . ' JPEG, JPG, PNG, webP, GIF.',
            'image.max' => __('messages.The image size should not exceed 2MB'),
        ]);
    
        $customBackground = $request->file('image');
    
        if ($customBackground) {
            $directory = base_path('assets/img/background-img/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach ($files as $file) {
                if (strpos($file, $userId . '.') !== false) {
                    $pathinfo = $userId . "." . pathinfo($file, PATHINFO_EXTENSION);
                }
            }
    
            // Delete the user's current background image if it exists
            while (findBackground($userId) !== "error.error") {
                $avatarName = "assets/img/background-img/" . findBackground(Auth::id());
                unlink(base_path($avatarName));
            }
                
            $fileName = $userId . '_' . time() . "." . $customBackground->extension();
            $customBackground->move(base_path('assets/img/background-img/'), $fileName);
    
            if (extension_loaded('imagick')) {
                $imagePath = base_path('assets/img/background-img/') . $fileName;
                $image = new \Imagick($imagePath);
                $image->stripImage();
                $image->writeImage($imagePath);
            }
    
            return redirect('/studio/theme');
        }
    
        return redirect('/studio/theme')->with('error', 'Please select a valid image file.');
    }

    //Delete custom background image
    public function removeBackground()
    {
        $userId = Auth::user()->id;

        // Delete the user's current background image if it exists
        while (findBackground($userId) !== "error.error") {
            $avatarName = "assets/img/background-img/" . findBackground(Auth::id());
            unlink(base_path($avatarName));
        }

        return back();
    }


    //Show custom theme
    public function showTheme(request $request)
    {
        $userId = Auth::user()->id;

        $data['pages'] = User::where('id', $userId)->select('littlelink_name', 'theme')->get();

        return view('/studio/theme', $data);
    }

    //Save custom theme
    public function editTheme(request $request)
    {
        $request->validate([
            'zip' => 'sometimes|mimes:zip',
        ]);

        $userId = Auth::user()->id;

        $zipfile = $request->file('zip');

        $theme = $request->theme;
        $message = "";

        User::where('id', $userId)->update(['theme' => $theme]);



        if (!empty($zipfile)) {

            $zipfile->move(base_path('/themes'), "temp.zip");

            $zip = new ZipArchive;
            $zip->open(base_path() . '/themes/temp.zip');
            $zip->extractTo(base_path() . '/themes');
            $zip->close();
            unlink(base_path() . '/themes/temp.zip');

            // Removes version numbers from folder.

            $folder = base_path('themes');
            $regex = '/[0-9.-]/';
            $files = scandir($folder);

            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    if (preg_match($regex, $file)) {
                        $new_file = preg_replace($regex, '', $file);
                        File::copyDirectory($folder . '/' . $file, $folder . '/' . $new_file);
                        $dirname = $folder . '/' . $file;
                        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                            system('rmdir ' . escapeshellarg($dirname) . ' /s /q');
                        } else {
                            system("rm -rf " . escapeshellarg($dirname));
                        }
                    }
                }
            }
        }


        return Redirect('/studio/theme')->with("success", $message);
    }

    //Show user (name, email, password)
    public function showProfile(request $request)
    {
        $userId = Auth::user()->id;

        $data['profile'] = User::where('id', $userId)->select('name', 'email', 'role')->get();

        return view('/studio/profile', $data);
    }

    //Save user (name, email, password)
    public function editProfile(request $request)
    {
        $request->validate([
            'name' => 'sometimes|required|unique:users',
            'email' => 'sometimes|required|email|unique:users',
            'password' => 'sometimes|min:8',
        ]);

        $userId = Auth::user()->id;

        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);

        if ($request->name != '') {
            User::where('id', $userId)->update(['name' => $name]);
        } elseif ($request->email != '') {
            User::where('id', $userId)->update(['email' => $email]);
        } elseif ($request->password != '') {
            User::where('id', $userId)->update(['password' => $password]);
            Auth::logout();
        }
        return back();
    }

    //Show user theme credit page
    public function theme(request $request)
    {
        $littlelink_name = $request->littlelink;
        $id = User::select('id')->where('littlelink_name', $littlelink_name)->value('id');

        if (empty($id)) {
            return abort(404);
        }

        $userinfo = User::select('name', 'littlelink_name', 'littlelink_description', 'theme')->where('id', $id)->first();
        $information = User::select('name', 'littlelink_name', 'littlelink_description', 'theme')->where('id', $id)->get();

        $links = DB::table('links')->join('buttons', 'buttons.id', '=', 'links.button_id')->select('links.link', 'links.id', 'links.button_id', 'links.title', 'links.custom_css', 'links.custom_icon', 'buttons.name')->where('user_id', $id)->orderBy('up_link', 'asc')->orderBy('order', 'asc')->get();

        return view('components/theme', ['userinfo' => $userinfo, 'information' => $information, 'links' => $links, 'littlelink_name' => $littlelink_name]);
    }

    //Delete existing user
    public function deleteUser(request $request)
    {

        // echo $request->id;
        // echo "<br>";
        // echo Auth::id();
        $id = $request->id;

    if($id == Auth::id() and $id != "1") {

        Link::where('user_id', $id)->delete();

        $user = User::find($id);

        Schema::disableForeignKeyConstraints();
        $user->forceDelete();
        Schema::enableForeignKeyConstraints();
    }

        return redirect('/');
    }

    //Delete profile picture
    public function delProfilePicture()
    {
        $userId = Auth::user()->id;

        // Delete the user's current avatar if it exists
        while (findAvatar($userId) !== "error.error") {
            $avatarName = findAvatar($userId);
            unlink(base_path($avatarName));
        }

        return back();
    }

    //Export user links
    public function exportLinks(request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $links = Link::where('user_id', $userId)->get();
        
        if (!$user) {
            // handle the case where the user is null
            return response()->json(['message' => 'User not found'], 404);
        }

        $userData['links'] = $links->toArray();

        $domain = $_SERVER['HTTP_HOST'];
        $date = date('Y-m-d_H-i-s');
        $fileName = "links-$domain-$date.json";
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ];
        return response()->json($userData, 200, $headers);

        return back();
    }

    //Export all user data
    public function exportAll(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);
        $links = Link::where('user_id', $userId)->get();
    
        if (!$user) {
            // handle the case where the user is null
            return response()->json(['message' => 'User not found'], 404);
        }
    
        $userData = $user->toArray();
        $userData['links'] = $links->toArray();

        if (file_exists(base_path(findAvatar($userId)))){
            $imagePath = base_path(findAvatar($userId));
            $imageData = base64_encode(file_get_contents($imagePath));
            $userData['image_data'] = $imageData;
    
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $userData['image_extension'] = $imageExtension;
        }
    
        $domain = $_SERVER['HTTP_HOST'];
        $date = date('Y-m-d_H-i-s');
        $fileName = "user_data-$domain-$date.json";
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
        ];
        return response()->json($userData, 200, $headers);
    
        return back();
    }    

    public function importData(Request $request)
    {
        try {
            // Get the JSON data from the uploaded file
            if (!$request->hasFile('import') || !$request->file('import')->isValid()) {
                throw new \Exception('File not uploaded or is faulty');
            }
            $file = $request->file('import');
            $jsonString = $file->get();
            $userData = json_decode($jsonString, true);
    
            // Update the authenticated user's profile data if defined in the JSON file
            $user = auth()->user();
            if (isset($userData['name'])) {
                $user->name = $userData['name'];
            }

            if (isset($userData['littlelink_description'])) {
                $sanitizedText = $userData['littlelink_description'];
                $sanitizedText = strip_tags($sanitizedText, '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
                $sanitizedText = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $sanitizedText);
                $sanitizedText = strip_tags_except_allowed_protocols($sanitizedText);
                $user->littlelink_description = $sanitizedText;
            }

            if (isset($userData['image_data'])) {

                $allowedExtensions = array('jpeg', 'jpg', 'png', 'webp');
                $userExtension = strtolower($userData['image_extension']);

                if (in_array($userExtension, $allowedExtensions)) {
                // Decode the image data from Base64
                $imageData = base64_decode($userData['image_data']);

                // Delete the user's current avatar if it exists
                while (findAvatar(Auth::id()) !== "error.error") {
                    $avatarName = findAvatar(Auth::id());
                    unlink(base_path($avatarName));
                }
                
                // Save the image to the correct path with the correct file name and extension
                $filename = $user->id . '.' . $userExtension;
                file_put_contents(base_path('assets/img/' . $filename), $imageData);
                
                // Update the user's image field with the correct file name
                $user->image = $filename;
                }
            }

            $user->save();
    
            // Delete all links for the authenticated user
            Link::where('user_id', $user->id)->delete();
    
            // Loop through each link in $userData and create a new link for the user
            foreach ($userData['links'] as $linkData) {

                $validatedData = Validator::make($linkData, [
                    'link' => 'nullable|exturl',
                ]);

                if ($validatedData->fails()) {
                    throw new \Exception('Invalid link');
                }

                $newLink = new Link();
    
                // Copy over the link data from $linkData to $newLink
                $newLink->button_id = $linkData['button_id'];
                $newLink->link = $linkData['link'];
                
                // Sanitize the title
                if ($linkData['button_id'] == 93) {
                    $sanitizedText = strip_tags($linkData['title'], '<a><p><strong><i><ul><ol><li><blockquote><h2><h3><h4>');
                    $sanitizedText = preg_replace("/<a([^>]*)>/i", "<a $1 rel=\"noopener noreferrer nofollow\">", $sanitizedText);
                    $sanitizedText = strip_tags_except_allowed_protocols($sanitizedText);
                
                    $newLink->title = $sanitizedText;
                } else {
                    $newLink->title = $linkData['title'];
                }

                $newLink->order = $linkData['order'];
                $newLink->click_number = 0;
                $newLink->up_link = $linkData['up_link'];
                $newLink->custom_css = $linkData['custom_css'];
                $newLink->custom_icon = $linkData['custom_icon'];
    
                // Set the user ID to the current user's ID
                $newLink->user_id = $user->id;
    
                // Save the new link to the database
                $newLink->save();
            }
            return redirect('studio/profile')->with('success', __('messages.Profile updated successfully!'));
        } catch (\Exception $e) {
            return redirect('studio/profile')->with('error', __('messages.An error occurred while updating your profile.'));
        }
    }
    

    // Hanle reports
    function report(Request $request)
    {
        $formData = $request->all();
    
        try {
            Mail::to(env('ADMIN_EMAIL'))->send(new ReportSubmissionMail($formData));
            
            return redirect('report')->with('success', __('messages.report_success'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('messages.report_error'));
        }
    }

    //Edit/save page icons
    public function editIcons(Request $request)
    {
        $inputKeys = array_keys($request->except('_token'));

        $validationRules = [];

        foreach ($inputKeys as $platform) {
            $validationRules[$platform] = 'nullable|exturl|max:255';
        }

        $request->validate($validationRules);

        foreach ($inputKeys as $platform) {
            $link = $request->input($platform);

            if (!empty($link)) {
                $iconId = $this->searchIcon($platform);

                if (!is_null($iconId)) {
                    $this->updateIcon($platform, $link);
                } else {
                    $this->addIcon($platform, $link);
                }
            }
        }

        return redirect('studio/links#icons');
    }

    private function searchIcon($icon)
    {
        return DB::table('links')
            ->where('user_id', Auth::id())
            ->where('title', $icon)
            ->where('button_id', 94)
            ->value('id');
    }

    private function addIcon($icon, $link)
    {
        $userId = Auth::user()->id;
        $links = new Link;
        $links->link = $link;
        $links->user_id = $userId;
        $links->title = $icon;
        $links->button_id = '94';
        $links->save();
        $links->order = ($links->id - 1);
        $links->save();
    }

    private function updateIcon($icon, $link)
    {
        Link::where('id', $this->searchIcon($icon))->update([
            'button_id' => 94,
            'link' => $link,
            'title' => $icon
        ]);
    }
}