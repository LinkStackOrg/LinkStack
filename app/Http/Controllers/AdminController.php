<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

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

        switch ($usersType) {
            case 'all':
                $data['users'] = User::select('id', 'name', 'email', 'littlelink_name', 'role', 'block', 'email_verified_at')->get();
                return view('panel/users', $data);
                break;
            case 'user':
                $data['users'] = User::where('role', 'email', 'user')->select('id', 'name', 'littlelink_name', 'role', 'block', 'email_verified_at')->get();
                return view('panel/users', $data);
                break;
            case 'vip':
                $data['users'] = User::where('role', 'email', 'vip')->select('id', 'name', 'littlelink_name', 'role', 'block', 'email_verified_at')->get();
                return view('panel/users', $data);
                break;
            case 'admin':
                $data['users'] = User::where('role', 'email', 'admin')->select('id', 'name', 'littlelink_name', 'role', 'block', 'email_verified_at')->get();
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

        return redirect('panel/users/all');
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

        return redirect('panel/users/all');
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

        return redirect('panel/edit-user/' . $user->id);
    }

    //Delete existing user
    public function deleteUser(request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        Schema::disableForeignKeyConstraints();
        $user->forceDelete();
        Schema::enableForeignKeyConstraints();

        return redirect('panel/users/all');
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

        if ($request->password == '') {
            User::where('id', $id)->update(['name' => $name, 'email' => $email, 'littlelink_name' => $littlelink_name, 'littlelink_description' => $littlelink_description, 'role' => $role]);
        } else {
            User::where('id', $id)->update(['name' => $name, 'email' => $email, 'password' => $password, 'littlelink_name' => $littlelink_name, 'littlelink_description' => $littlelink_description, 'role' => $role]);
        }
        if (!empty($profilePhoto)) {
            $profilePhoto->move(base_path('/img'), $littlelink_name . ".png");
        }

        return redirect('panel/users/all');
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
            $directory = base_path('/littlelink/images/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, "avatar".'.') !== false) {
            $pathinfo = "avatar". "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            if(file_exists(base_path('/littlelink/images/').$pathinfo)){File::delete(base_path('/littlelink/images/').$pathinfo);}

            $logo->move(base_path('/littlelink/images/'), "avatar.".$request->file('image')->extension());
        }

        if (!empty($icon)) {
            // Delete existing image
            $directory = base_path('/littlelink/images/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, "favicon".'.') !== false) {
            $pathinfo = "favicon". "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            if(file_exists(base_path('/littlelink/images/').$pathinfo)){File::delete(base_path('/littlelink/images/').$pathinfo);}

            $icon->move(base_path('/littlelink/images/'), "favicon.".$request->file('icon')->extension());
        }
        return back();
    }

    //Delete avatar
    public function delAvatar()
    {
            // Delete existing image
            $directory = base_path('/littlelink/images/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, "avatar".'.') !== false) {
            $pathinfo = "avatar". "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            if(file_exists(base_path('/littlelink/images/').$pathinfo)){File::delete(base_path('/littlelink/images/').$pathinfo);}
        
        return back();
    }

    //Delete favicon
    public function delFavicon()
    {
            // Delete existing image
            $directory = base_path('/littlelink/images/');
            $files = scandir($directory);
            $pathinfo = "error.error";
            foreach($files as $file) {
            if (strpos($file, "favicon".'.') !== false) {
            $pathinfo = "favicon". "." . pathinfo($file, PATHINFO_EXTENSION);
            }}
            if(file_exists(base_path('/littlelink/images/').$pathinfo)){File::delete(base_path('/littlelink/images/').$pathinfo);}

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

    //Statistics of the number of clicks and links
    public function phpinfo()
    {
        return view('panel/phpinfo');
    }

    //Shows config file editor page
    public function showFileEditor(request $request)
    {
        return view('/panel/config');
    }

    //Saves advanced config
    public function editAC(request $request)
    {
        $AdvancedConfig = $request->AdvancedConfig;

        file_put_contents('config/advanced-config.php', $AdvancedConfig);

        return redirect('/panel/config#2');
    }

    //Saves .env config
    public function editENV(request $request)
    {
        $config = $request->altConfig;

        file_put_contents('.env', $config);

        return Redirect('/panel/config?alternative-config');
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

                if (is_dir($folderName))

                    $folderHandle = opendir($folderName);



                if (!$folderHandle)

                    return false;



                while ($file = readdir($folderHandle)) {

                    if ($file != "." && $file != "..") {

                        if (!is_dir($folderName . "/" . $file))

                            unlink($folderName . "/" . $file);

                        else

                            removeFolder($folderName . '/' . $file);
                    }
                }



                closedir($folderHandle);

                rmdir($folderName);
            }

            removeFolder($folderName);

            return Redirect('/panel/theme');
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
            if(EnvEditor::keyExists('MAIL_USERNAME')){EnvEditor::editKey('MAIL_USERNAME', $request->MAIL_USERNAME);}
            if(EnvEditor::keyExists('MAIL_PASSWORD')){EnvEditor::editKey('MAIL_PASSWORD', $request->MAIL_PASSWORD);}
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




        return Redirect('/panel/config');
    }
    
    //Shows theme editor page
    public function showThemes(request $request)
    {
        return view('/panel/theme');
    }
}
