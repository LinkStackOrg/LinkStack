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

        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')->get();
        $lastMonthCount = $users->where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $lastWeekCount = $users->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $last24HrsCount = $users->where('created_at', '>=', Carbon::now()->subHours(24))->count();
        $updatedLast30DaysCount = $users->where('updated_at', '>=', Carbon::now()->subDays(30))->count();
        $updatedLast7DaysCount = $users->where('updated_at', '>=', Carbon::now()->subDays(7))->count();
        $updatedLast24HrsCount = $users->where('updated_at', '>=', Carbon::now()->subHours(24))->count();

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

        return view('panel/index', ['lastMonthCount' => $lastMonthCount,'lastWeekCount' => $lastWeekCount,'last24HrsCount' => $last24HrsCount,'updatedLast30DaysCount' => $updatedLast30DaysCount,'updatedLast7DaysCount' => $updatedLast7DaysCount,'updatedLast24HrsCount' => $updatedLast24HrsCount,'toplinks' => $topLinks, 'links' => $links, 'clicks' => $clicks, 'pageStats' => $pageStats, 'littlelink_name' => $littlelink_name, 'links' => $links, 'clicks' => $clicks, 'siteLinks' => $siteLinks, 'siteClicks' => $siteClicks, 'userNumber' => $userNumber]);
    }

// Get users by type
public function users(Request $request)
{
    // Query to get the admin user with non-null 'auth_as' value
    $adminUser = User::whereNotNull('auth_as')->where('role', 'admin')->first();

    $usersType = $request->type;

    $usersQuery = User::select('id', 'name', 'email', 'littlelink_name', 'role', 'block', 'email_verified_at', 'created_at', 'updated_at');

    switch ($usersType) {
        case 'user':
            $usersQuery->where('role', 'user');
            break;
        case 'vip':
            $usersQuery->where('role', 'vip');
            break;
        case 'admin':
            $usersQuery->where('role', 'admin');
            break;
    }

    $users = $usersQuery->get();

    // Rest of your code to calculate click counts and link counts for each user

    foreach ($users as $user) {
        $user->clicks = Link::where('user_id', $user->id)->sum('click_number');
        $user->links = Link::where('user_id', $user->id)->select('link')->count();
    }

    $data['users'] = $users;
    $data['adminUser'] = $adminUser;

    return view('panel/users', $data);
}

    //Search user by name
    public function searchUser(Request $request)
    {
        $searchTerm = $request->search;
        $data['users'] = User::where('name', 'like', "%{$searchTerm}%")
                              ->orWhere('email', 'like', "%{$searchTerm}%")
                              ->orWhere('littlelink_name', 'like', "%{$searchTerm}%")
                            //   ->orWhere('role', 'like', "%{$searchTerm}%")
                            //   ->orWhere('block', 'like', "%{$searchTerm}%")
                            //   ->orWhere('email_verified_at', 'like', "%{$searchTerm}%")
                              ->select('id', 'email', 'name', 'littlelink_name', 'role', 'block', 'email_verified_at', 'created_at', 'updated_at')
                              ->get();
        return view('panel/users', $data);
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

    //Verify or un-verify users emails
    public function verifyUser(request $request)
    {
        $id = $request->id;
        $status = $request->verify;

        if ($status == '-') {
            $verify = '0000-00-00 00:00:00';
        } else {
            $verify = NULL;
        }

        User::where('id', $id)->update(['email_verified_at' => $verify]);

        return redirect('admin/users/all');
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

        $user = User::create([
            'name' => 'Admin-Created-' . random_str(8),
            'email' => random_str(8) . '@example.com',
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
        $profile_picture_width = $request->profile_picture_width;
        $profile_picture_height = $request->profile_picture_height;
        $littlelink_name = $request->littlelink_name;
        $littlelink_description = $request->littlelink_description;
        $role = $request->role;
        $customBackground = $request->file('background');
        $theme = $request->theme;

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
        return redirect('/panel/config');
    }

    //Saves advanced config
    public function editAC(request $request)
    {
        $AdvancedConfig = $request->AdvancedConfig;

        file_put_contents('config/advanced-config.php', $AdvancedConfig);

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

}
