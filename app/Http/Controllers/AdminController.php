<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use GeoSot\EnvEditor\Controllers\EnvController;
use GeoSot\EnvEditor\Exceptions\EnvException;
use GeoSot\EnvEditor\Helpers\EnvFileContentManager;
use GeoSot\EnvEditor\Helpers\EnvFilesManager;
use GeoSot\EnvEditor\Helpers\EnvKeysManager;
use GeoSot\EnvEditor\Facades\EnvEditor;
use GeoSot\EnvEditor\ServiceProvider;

use Auth;
use Exception;
use ZipArchive;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Admin;
use App\Models\Button;
use App\Models\Link;
use App\Models\Page;
use App\Models\UserData;

class AdminController extends Controller
{
    //Statistics of the number of clicks and links
    public function index()
    {
        return view('panel/index');
    }
    
    public function stats()
    {
        $user = Auth::user();
        $userId = $user->id;
        $littlelink_name = $user->littlelink_name;
    
        $topLinks = Link::where('user_id', $userId)
            ->whereNotNull('link')
            ->where('link', '<>', '')
            ->orderBy('click_number', 'desc')
            ->take(5)
            ->get();

            // Combine queries for user-specific data
            $userLinksData = Link::where('user_id', $userId)
            ->selectRaw('COUNT(*) as links, SUM(click_number) as clicks')
            ->first();

        if ($user->role == 'admin') {

            // Combine queries for site-wide data
            $siteLinksData = Link::selectRaw('COUNT(*) as siteLinks, SUM(click_number) as siteClicks')
                ->first();

            // Combine queries for user counts
            $userCounts = User::selectRaw('COUNT(*) as userNumber, 
                                           SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as lastMonthCount, 
                                           SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as lastWeekCount, 
                                           SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as last24HrsCount, 
                                           SUM(CASE WHEN updated_at >= ? THEN 1 ELSE 0 END) as updatedLast30DaysCount, 
                                           SUM(CASE WHEN updated_at >= ? THEN 1 ELSE 0 END) as updatedLast7DaysCount, 
                                           SUM(CASE WHEN updated_at >= ? THEN 1 ELSE 0 END) as updatedLast24HrsCount', [
                Carbon::now()->subDays(30),
                Carbon::now()->subDays(7),
                Carbon::now()->subHours(24),
                Carbon::now()->subDays(30),
                Carbon::now()->subDays(7),
                Carbon::now()->subHours(24)
            ])->first();
        }
    
        return view('studio/index', [
            'links' => $userLinksData->links ?? 0,
            'clicks' => $userLinksData->clicks ?? 0,
            'userNumber' => $userCounts->userNumber ?? 0,
            'siteLinks' => $siteLinksData->siteLinks ?? 0,
            'siteClicks' => $siteLinksData->siteClicks ?? 0,
            'lastMonthCount' => $userCounts->lastMonthCount ?? 0,
            'lastWeekCount' => $userCounts->lastWeekCount ?? 0,
            'last24HrsCount' => $userCounts->last24HrsCount ?? 0,
            'updatedLast30DaysCount' => $userCounts->updatedLast30DaysCount ?? 0,
            'updatedLast7DaysCount' => $userCounts->updatedLast7DaysCount ?? 0,
            'updatedLast24HrsCount' => $userCounts->updatedLast24HrsCount ?? 0,
            'toplinks' => $topLinks ?? [],
        ]);
    }

// Users page
public function users()
{
    return view('panel/users');
}

// Send test mail
public function SendTestMail(Request $request)
{
    try {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        
        Mail::send('auth.test', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Test Email');
        });
        
        return redirect()->route('showConfig')->with('success', 'Test email sent successfully!');
    } catch (\Exception $e) {
        return redirect()->route('showConfig')->with('fail', 'Failed to send test email.');
    }
}

    //Block user
    public function blockUser(request $request)
    {
        $id = $request->id;
        $status = $request->block;

        if ($status == 'yes') {
            $block = 'no';
        } elseif ($status == 'no') {
            $block = 'yes';
        }

        User::where('id', $id)->update(['block' => $block]);

        return redirect('admin/users/all');
    }

    //Verify user
    public function verifyCheckUser(request $request)
    {
        $id = $request->id;
        $status = $request->verify;

        if ($status == 'vip') {
            $verify = 'vip';
            UserData::saveData($id, 'checkmark', true);
        } elseif ($status == 'user') {
            $verify = 'user';
        }

        User::where('id', $id)->update(['role' => $verify]);

        return redirect(url('u')."/".$id);
    }

    //Verify or un-verify users emails
    public function verifyUser(request $request)
    {
        $id = $request->id;
        $status = $request->verify;

        if ($status == "true") {
            $verify = '0000-00-00 00:00:00';
        } else {
            $verify = NULL;
        }

        User::where('id', $id)->update(['email_verified_at' => $verify]);
    }

    //Create new user from the Admin Panel
    public function createNewUser()
    {

        function random_str(
            int $length = 64,
            string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
            if ($length < 1) {
                throw new \RangeException("Length must be a positive integer");
            }
            $pieces = [];
            $max = mb_strlen($keyspace, '8bit') - 1;
            for ($i = 0; $i < $length; ++$i) {
                $pieces[] = $keyspace[random_int(0, $max)];
            }
            return implode('', $pieces);
        }

        $names = User::pluck('name')->toArray();

        $adminCreatedNames = array_filter($names, function($name) {
            return strpos($name, 'Admin-Created-') === 0;
        });

        $numbers = array_map(function($name) {
            return (int) str_replace('Admin-Created-', '', $name);
        }, $adminCreatedNames);

        $maxNumber = !empty($numbers) ? max($numbers) : 0;
        $newNumber = $maxNumber + 1;

        $domain = parse_url(url(''), PHP_URL_HOST);
        $domain = ($domain == 'localhost') ? 'example.com' : $domain;

        $user = User::create([
            'name' => 'Admin-Created-' . $newNumber,
            'email' => strtolower(random_str(8)) . '@' . $domain,
            'password' => Hash::make(random_str(32)),
            'role' => 'user',
            'block' => 'no',
        ]);

        return redirect('admin/edit-user/' . $user->id);
    }

    //Delete existing user
    public function deleteUser(request $request)
    {
        $id = $request->id;

        Link::where('user_id', $id)->delete();
    
        Schema::disableForeignKeyConstraints();
        
        $user = User::find($id);
        $user->forceDelete();
    
        Schema::enableForeignKeyConstraints();
    
        return redirect('admin/users/all');
    }

    //Delete existing user with POST request
    public function deleteTableUser(request $request)
    {
        $id = $request->id;

        Link::where('user_id', $id)->delete();
    
        Schema::disableForeignKeyConstraints();
        
        $user = User::find($id);
        $user->forceDelete();
    
        Schema::enableForeignKeyConstraints();
    }

    //Show user to edit
    public function showUser(request $request)
    {
        $id = $request->id;

        $data['user'] = User::where('id', $id)->get();

        return view('panel/edit-user', $data);
    }

    //Show link, click number, up link in links page
    public function showLinksUser(request $request)
    {
        $id = $request->id;

        $data['user'] = User::where('id', $id)->get();

        $data['links'] = Link::select('id', 'link', 'title', 'order', 'click_number', 'up_link', 'links.button_id')->where('user_id', $id)->orderBy('up_link', 'asc')->orderBy('order', 'asc')->paginate(10);
        return view('panel/links', $data);
    }

    //Delete link
    public function deleteLinkUser(request $request)
    {
        $linkId = $request->id;

        Link::where('id', $linkId)->delete();

        return back();
    }

    //Save user edit
    public function editUser(request $request)
    {
        $request->validate([
            'name' => '',
            'email' => '',
            'password' => '',
            'littlelink_name' => '',
        ]);

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $profilePhoto = $request->file('image');
        $littlelink_name = $request->littlelink_name;
        $littlelink_description = $request->littlelink_description;
        $role = $request->role;
        $customBackground = $request->file('background');
        $theme = $request->theme;

        if(User::where('id', $id)->get('role')->first()->role =! $role) {
            if ($role == 'vip') {
                UserData::saveData($id, 'checkmark', true);
            }
        }

        if ($request->password == '') {
            User::where('id', $id)->update(['name' => $name, 'email' => $email, 'littlelink_name' => $littlelink_name, 'littlelink_description' => $littlelink_description, 'role' => $role, 'theme' => $theme]);
        } else {
            User::where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password, 'littlelink_name' => $littlelink_name, 'littlelink_description' => $littlelink_description, 'role' => $role, 'theme' => $theme]);
        }
        if (!empty($profilePhoto)) {
            $profilePhoto->move(base_path('assets/img'), $id . '_' . time() . ".png");
        } 
        if (!empty($customBackground)) {
            $directory = base_path('assets/img/background-img/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, $id.'.') !== false) {
            $pathinfo = $id. "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            if(file_exists(base_path('assets/img/background-img/').$pathinfo)){File::delete(base_path('assets/img/background-img/').$pathinfo);}
    
            $customBackground->move(base_path('assets/img/background-img/'), $id . '_' . time() . "." . $request->file('background')->extension());
        } 

        return redirect('admin/users/all');
    }

    //Show site pages to edit
    public function showSitePage()
    {
        $data['pages'] = Page::select('terms', 'privacy', 'contact', 'register')->get();
        return view('panel/pages', $data);
    }

    //Save site pages
    public function editSitePage(request $request)
    {
        $terms = $request->terms;
        $privacy = $request->privacy;
        $contact = $request->contact;
        $register = $request->register;

        Page::first()->update(['terms' => $terms, 'privacy' => $privacy, 'contact' => $contact, 'register' => $register]);

        return back();
    }

    //Show home message for edit
    public function showSite()
    {
        $message = Page::select('home_message')->first();
        return view('panel/site', $message);
    }

    //Save home message, logo and favicon
    public function editSite(request $request)
    {
        $message = $request->message;
        $logo = $request->file('image');
        $icon = $request->file('icon');

        Page::first()->update(['home_message' => $message]);

        if (!empty($logo)) {
            // Delete existing image
            $path = findFile('avatar');
            $path = base_path('/assets/linkstack/images/'.$path);
    
                // Delete existing image
                if (File::exists($path)) {
                    File::delete($path);
                }

            $logo->move(base_path('/assets/linkstack/images/'), "avatar" . '_' . time() . "." .$request->file('image')->extension());
        }

        if (!empty($icon)) {
            // Delete existing image
            $path = findFile('favicon');
            $path = base_path('/assets/linkstack/images/'.$path);
    
                // Delete existing image
                if (File::exists($path)) {
                    File::delete($path);
                }

            $icon->move(base_path('/assets/linkstack/images/'), "favicon" . '_' . time() . "." . $request->file('icon')->extension());
        }
        return back();
    }

    //Delete avatar
    public function delAvatar()
    {
        $path = findFile('avatar');
        $path = base_path('/assets/linkstack/images/'.$path);

            // Delete existing image
            if (File::exists($path)) {
                File::delete($path);
            }
        
        return back();
    }

    //Delete favicon
    public function delFavicon()
    {
            // Delete existing image
            $path = findFile('favicon');
            $path = base_path('/assets/linkstack/images/'.$path);
    
                // Delete existing image
                if (File::exists($path)) {
                    File::delete($path);
                }

        return back();
    }

    //View footer page: terms
    public function pagesTerms(Request $request)
    {
        $name = "terms";
    
        try {
            $data['page'] = Page::select($name)->first();
        } catch (Exception $e) {
            return abort(404);
        }
    
        return view('pages', ['data' => $data, 'name' => $name]);
    }

    //View footer page: privacy
    public function pagesPrivacy(Request $request)
    {
        $name = "privacy";
    
        try {
            $data['page'] = Page::select($name)->first();
        } catch (Exception $e) {
            return abort(404);
        }
    
        return view('pages', ['data' => $data, 'name' => $name]);
    }

    //View footer page: contact
    public function pagesContact(Request $request)
    {
        $name = "contact";
    
        try {
            $data['page'] = Page::select($name)->first();
        } catch (Exception $e) {
            return abort(404);
        }
    
        return view('pages', ['data' => $data, 'name' => $name]);
    }

    //Statistics of the number of clicks and links
    public function phpinfo()
    {
        return view('panel/phpinfo');
    }

    //Shows config file editor page
    public function showFileEditor(request $request)
    {
        return redirect('/admin/config');
    }

    //Saves advanced config
    public function editAC(request $request)
    {
        if ($request->ResetAdvancedConfig == 'RESET_DEFAULTS') {
            copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php')); 
        } else {
            file_put_contents('config/advanced-config.php', $request->AdvancedConfig);
        }

        return redirect('/admin/config#2');
    }

    //Saves .env config
    public function editENV(request $request)
    {
        $config = $request->altConfig;

        file_put_contents('.env', $config);

        return Redirect('/admin/config?alternative-config');
    }

    //Shows config file editor page
    public function showBackups(request $request)
    {
        return view('/panel/backups');
    }

    //Delete custom theme
    public function deleteTheme(request $request)
    {

        $del = $request->deltheme;

        if (empty($del)) {
            echo '<script type="text/javascript">';
            echo 'alert("No themes to delete!");';
            echo 'window.location.href = "../studio/theme";';
            echo '</script>';
        } else {

            $folderName = base_path() . '/themes/' . $del;



            function removeFolder($folderName)
            {
                if (File::exists($folderName)) {
                    File::deleteDirectory($folderName);
                    return true;
                }
            
                return false;
            }

            removeFolder($folderName);

            return Redirect('/admin/theme');
        }
    }

    // Update themes
    public function updateThemes()
    {


        if ($handle = opendir('themes')) {
            while (false !== ($entry = readdir($handle))) {

                if (file_exists(base_path('themes') . '/' . $entry . '/readme.md')) {
                    $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                    $pattern = '/Theme Version:.*/';
                    preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                    if (!count($matches)) continue;
                    $verNr = substr($matches[0][0], 15);

                }


                $themeVe = NULL;

                if ($entry != "." && $entry != "..") {
                    if (file_exists(base_path('themes') . '/' . $entry . '/readme.md')) {
                        if (!strpos(file_get_contents(base_path('themes') . '/' . $entry . '/readme.md'), 'Source code:')) {
                            $hasSource = false;
                        } else {
                            $hasSource = true;

                            $text = file_get_contents(base_path('themes') . '/' . $entry . '/readme.md');
                            $pattern = '/Source code:.*/';
                            preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);
                            $sourceURL = substr($matches[0][0], 13);

                            $replaced = str_replace("https://github.com/", "https://raw.githubusercontent.com/", trim($sourceURL));
                            $replaced = $replaced . "/main/readme.md";

                            if (strpos($sourceURL, 'github.com')) {

                                ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');
                                try {
                                    $textGit = file_get_contents($replaced);
                                    $patternGit = '/Theme Version:.*/';
                                    preg_match($patternGit, $textGit, $matches, PREG_OFFSET_CAPTURE);
                                    $sourceURLGit = substr($matches[0][0], 15);
                                    $Vgitt = 'v' . $sourceURLGit;
                                    $verNrv = 'v' . $verNr;
                                } catch (Exception $ex) {
                                    $themeVe = "error";
                                    $Vgitt = NULL;
                                    $verNrv = NULL;
                                }

                                if (trim($Vgitt) > trim($verNrv)) {


                                    $fileUrl = trim($sourceURL) . '/archive/refs/tags/' . trim($Vgitt) . '.zip';


                                    file_put_contents(base_path('themes/theme.zip'), fopen($fileUrl, 'r'));


                                    $zip = new ZipArchive;
                                    $zip->open(base_path() . '/themes/theme.zip');
                                    $zip->extractTo(base_path('themes'));
                                    $zip->close();
                                    unlink(base_path() . '/themes/theme.zip');

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
                            }
                        }
                    }
                }
            }
        }

        return Redirect('/studio/theme');
    }

    //Shows config file editor page
    public function showConfig(request $request)
    {
        return view('/panel/config-editor');
    }

    //Shows config file editor page
    public function editConfig(request $request)
    {

        $type = $request->type;
        $entry = $request->entry;
        $value = $request->value;

        if($type === "toggle"){
            if($request->toggle != ''){$value = "true";}else{$value = "false";}
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, $value);}
        } elseif($type === "toggle2") {
            if($request->toggle != ''){$value = "verified";}else{$value = "auth";}
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, $value);}
        } elseif($type === "text") {
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, '"' . $value . '"');}
        } elseif($type === "debug") {
            if($request->toggle != ''){
                if(EnvEditor::keyExists('APP_DEBUG')){EnvEditor::editKey('APP_DEBUG', 'true');}
                if(EnvEditor::keyExists('APP_ENV')){EnvEditor::editKey('APP_ENV', 'local');}
                if(EnvEditor::keyExists('LOG_LEVEL')){EnvEditor::editKey('LOG_LEVEL', 'debug');}
            } else {
                if(EnvEditor::keyExists('APP_DEBUG')){EnvEditor::editKey('APP_DEBUG', 'false');}
                if(EnvEditor::keyExists('APP_ENV')){EnvEditor::editKey('APP_ENV', 'production');}
                if(EnvEditor::keyExists('LOG_LEVEL')){EnvEditor::editKey('LOG_LEVEL', 'error');}
            }
        } elseif($type === "register") {
            if($request->toggle != ''){$register = "true";}else{$register = "false";}
            Page::first()->update(['register' => $register]);
        } elseif($type === "smtp") {
            if($request->toggle != ''){$value = "built-in";}else{$value = "smtp";}
            if(EnvEditor::keyExists('MAIL_MAILER')){EnvEditor::editKey('MAIL_MAILER', $value);}

            if(EnvEditor::keyExists('MAIL_HOST')){EnvEditor::editKey('MAIL_HOST', $request->MAIL_HOST);}
            if(EnvEditor::keyExists('MAIL_PORT')){EnvEditor::editKey('MAIL_PORT', $request->MAIL_PORT);}
            if(EnvEditor::keyExists('MAIL_USERNAME')){EnvEditor::editKey('MAIL_USERNAME', '"' . $request->MAIL_USERNAME . '"');}
            if(EnvEditor::keyExists('MAIL_PASSWORD')){EnvEditor::editKey('MAIL_PASSWORD', '"' . $request->MAIL_PASSWORD . '"');}
            if(EnvEditor::keyExists('MAIL_ENCRYPTION')){EnvEditor::editKey('MAIL_ENCRYPTION', $request->MAIL_ENCRYPTION);}
            if(EnvEditor::keyExists('MAIL_FROM_ADDRESS')){EnvEditor::editKey('MAIL_FROM_ADDRESS', $request->MAIL_FROM_ADDRESS);}
        } elseif($type === "homeurl") {
            if($request->value == 'default'){$value = "";}else{$value = '"' . $request->value . '"';}
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, $value);}
        } elseif($type === "maintenance") {
            if($request->toggle != ''){$value = "true";}else{$value = "false";}
            if(file_exists(base_path("storage/MAINTENANCE"))){unlink(base_path("storage/MAINTENANCE"));}
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, $value);}
        } else {
            if(EnvEditor::keyExists($entry)){EnvEditor::editKey($entry, $value);}
        }




        return Redirect('/admin/config');
    }
    
    //Shows theme editor page
    public function showThemes(request $request)
    {
        return view('/panel/theme');
    }

    //Removes impersonation if authenticated
    public function authAs(request $request)
    {

        $userID = $request->id;
        $token = $request->token;

        $user = User::find($userID);

        if($user->remember_token == $token && $request->session()->get('display_auth_nav') === $user->remember_token){
            $user->auth_as = null;
            $user->remember_token = null;
            $user->save();

            $request->session()->forget('display_auth_nav');

            Auth::loginUsingId($userID);

        return redirect('/admin/users/all');
        } else {
            Auth::logout();
        }

    }

    //Add impersonation
    public function authAsID(request $request)
    {

        $adminUser = User::whereNotNull('auth_as')->where('role', 'admin')->first();

        if (!$adminUser) {

        $userID = $request->id;
        $id = Auth::user()->id;

        $user = User::find($id);

        $user->auth_as = $userID;
        $user->save();

        return redirect('dashboard');

        } else {
            return redirect('admin/users/all');
        }

    }

    //Show info about link
    public function redirectInfo(request $request)
    {
        $linkId = $request->id;

        if (empty($linkId)) {
            return abort(404);
        }
        
        $linkData = Link::find($linkId);
        $clicks = $linkData->click_number;

        if (empty($linkData)) {
            return abort(404);
        }

        function isValidLink($url) {
            $validPrefixes = array('http', 'https', 'ftp', 'mailto', 'tel', 'news');
        
            $pattern = '/^(' . implode('|', $validPrefixes) . '):/i';
        
            if (preg_match($pattern, $url) && strlen($url) <= 155) {
                return $url;
            } else {
                return "N/A";
            }
        }

        $link = isValidLink($linkData->link);

        $userID = $linkData->user_id;
        $userData = User::find($userID);

        return view('linkinfo', ['clicks' => $clicks, 'linkID' => $linkId, 'link' => $link, 'id' => $userID, 'userData' => $userData]);

    }

}
