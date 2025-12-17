<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\LinkTypeViewController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Prevents section below from being run by 'composer update'
if(file_exists(base_path('storage/app/ISINSTALLED'))){
  // generates new APP KEY if no one is set
  if(EnvEditor::getKey('APP_KEY')==''){try{Artisan::call('key:generate');} catch (exception $e) {}}
 
  // copies template meta config if none is present
  if(!file_exists(base_path("config/advanced-config.php"))){copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php'));}
 }

 // Installer
if(file_exists(base_path('INSTALLING')) or file_exists(base_path('INSTALLERLOCK'))){

  Route::get('/', [InstallerController::class, 'showInstaller'])->name('showInstaller');
  Route::post('/create-admin', [InstallerController::class, 'createAdmin'])->name('createAdmin');
  Route::post('/db', [InstallerController::class, 'db'])->name('db');
  Route::post('/mysql', [InstallerController::class, 'mysql'])->name('mysql');
  Route::post('/options', [InstallerController::class, 'options'])->name('options');
  Route::get('/mysql-test', [InstallerController::class, 'mysqlTest'])->name('mysqlTest');
  Route::get('/skip', function () {Artisan::call('db:seed', ['--class' => 'AdminSeeder',]); Auth::login(User::where('name', 'admin')->first()); return redirect(url('dashboard'));});
  Route::post('/editConfigInstaller', [InstallerController::class, 'editConfigInstaller'])->name('editConfigInstaller');

  Route::get('{any}', function() {
    if(!DB::table('users')->get()->isEmpty()){
    if(file_exists(base_path("INSTALLING")) and !file_exists(base_path('INSTALLERLOCK'))){unlink(base_path("INSTALLING"));header("Refresh:0");}
    } else {
      return redirect(url(''));
    }
  })->where('any', '.*');

}else{

// Disables routes if in Maintenance Mode
if(env('MAINTENANCE_MODE') != 'true'){

require __DIR__.'/home.php';

//Redirect if no page URL is set
Route::get('/@', function () {
    return redirect('/studio/no_page_name');
});

//Show diagnose page
Route::get('/panel/diagnose', function () {
        return view('panel/diagnose', []);
});

//Public route
$custom_prefix = config('advanced-config.custom_url_prefix');
Route::get('/going/{id?}', [UserController::class, 'clickNumber'])->where('link', '.*')->name('clickNumber')->middleware('disableCookies');
Route::get('/info/{id?}', [AdminController::class, 'redirectInfo'])->name('redirectInfo');
if($custom_prefix != ""){Route::get('/' . $custom_prefix . '{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');}
Route::get('/@{littlelink}', [UserController::class, 'littlelink'])->name('littlelink')->middleware('disableCookies');
Route::get('/pages/'.strtolower(footer('Terms')), [AdminController::class, 'pagesTerms'])->name('pagesTerms')->middleware('disableCookies');
Route::get('/pages/'.strtolower(footer('Privacy')), [AdminController::class, 'pagesPrivacy'])->name('pagesPrivacy')->middleware('disableCookies');
Route::get('/pages/'.strtolower(footer('Contact')), [AdminController::class, 'pagesContact'])->name('pagesContact')->middleware('disableCookies');
Route::get('/theme/@{littlelink}', [UserController::class, 'theme'])->name('theme');
Route::get('/vcard/{id?}', [UserController::class, 'vcard'])->name('vcard');
Route::get('/u/{id?}', [UserController::class, 'userRedirect'])->name('userRedirect');

Route::get('/report', function () {return view('report');});
Route::post('/report', [UserController::class, 'report'])->name('report');

Route::get('/demo-page', [App\Http\Controllers\HomeController::class, 'demo'])->name('demo')->middleware('disableCookies');

Route::get('/block-asset/{type}', [LinkTypeViewController::class, 'blockAsset'])
  ->name('block.asset')->where(['type' => '[a-zA-Z0-9_-]+']);

}

Route::middleware(['auth', 'blocked', 'impersonate'])->group(function () {
//User route
Route::group([
    'middleware' => env('REGISTER_AUTH'),
], function () {
if(env('FORCE_ROUTE_HTTPS') == 'true'){URL::forceScheme('https');}
if(isset($_COOKIE['LinkCount'])){if($_COOKIE['LinkCount'] == '20'){$LinkPage = 'showLinks20';}elseif($_COOKIE['LinkCount'] == '30'){$LinkPage = 'showLinks30';}elseif($_COOKIE['LinkCount'] == 'all'){$LinkPage = 'showLinksAll';} else {$LinkPage = 'showLinks';}} else {$LinkPage = 'showLinks';} //Shows correct link number
Route::get('/dashboard', [AdminController::class, 'index'])->name('panelIndex');
Route::get('/dashboard/site-stats', [AdminController::class, 'stats']);
Route::get('/dashboard/notifications', function () {return view('layouts.notifications', []);});
Route::get('/studio/index', function(){return redirect(url('dashboard'));});
Route::get('/studio/add-link', [UserController::class, 'AddUpdateLink'])->name('showButtons');
Route::post('/studio/edit-link', [UserController::class, 'saveLink'])->name('addLink');
Route::get('/studio/edit-link/{id}', [UserController::class, 'AddUpdateLink'])->name('showLink')->middleware('link-id');
Route::post('/studio/sort-link', [UserController::class, 'sortLinks'])->name('sortLinks');
Route::get('/studio/links', [UserController::class, $LinkPage])->name($LinkPage);
Route::get('/studio/theme', [UserController::class, 'showTheme'])->name('showTheme');
Route::post('/studio/theme', [UserController::class, 'editTheme'])->name('editTheme');
Route::get('/deleteLink/{id}', [UserController::class, 'deleteLink'])->name('deleteLink')->middleware('link-id');
Route::get('/upLink/{up}/{id}', [UserController::class, 'upLink'])->name('upLink')->middleware('link-id');
Route::post('/studio/edit-link/{id}', [UserController::class, 'editLink'])->name('editLink')->middleware('link-id');
Route::get('/studio/button-editor/{id}', [UserController::class, 'showCSS'])->name('showCSS')->middleware('link-id');
Route::post('/studio/button-editor/{id}', [UserController::class, 'editCSS'])->name('editCSS')->middleware('link-id');
Route::get('/studio/page', [UserController::class, 'showPage'])->name('showPage');
Route::get('/studio/no_page_name', [UserController::class, 'showPage'])->name('showPage');
Route::post('/studio/page', [UserController::class, 'editPage'])->name('editPage');
Route::post('/studio/background', [UserController::class, 'themeBackground'])->name('themeBackground');
Route::get('/studio/rem-background', [UserController::class, 'removeBackground'])->name('removeBackground');
Route::get('/studio/profile', [UserController::class, 'showProfile'])->name('showProfile');
Route::post('/studio/profile', [UserController::class, 'editProfile'])->name('editProfile');
Route::post('/edit-icons', [UserController::class, 'editIcons'])->name('editIcons');
Route::get('/clearIcon/{id}', [UserController::class, 'clearIcon'])->name('clearIcon');
Route::get('/studio/page/delprofilepicture', [UserController::class, 'delProfilePicture'])->name('delProfilePicture');
Route::get('/studio/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser')->middleware('verified');
Route::post('/auth-as', [AdminController::class, 'authAs'])->name('authAs');

// Catch all redirects
Route::get('/admin/users/all', fn() => redirect(route('showUsers')));
Route::get('/studio', fn() => redirect(url('dashboard')));
Route::get('/studio/edit-link', fn() => redirect(url('dashboard')));

if(env('ALLOW_USER_EXPORT') != false){
  Route::get('/export-links', [UserController::class, 'exportLinks'])->name('exportLinks');
  Route::get('/export-all', [UserController::class, 'exportAll'])->name('exportAll');
}
if(env('ALLOW_USER_IMPORT') != false){
  Route::post('/import-data', [UserController::class, 'importData'])->name('importData');
}
Route::get('/studio/linkparamform_part/{typeid}/{linkid}', [LinkTypeViewController::class, 'getParamForm'])->name('linkparamform.part');
});
});
}

//Social login route
Route::get('/social-auth/{provider}/callback', [SocialLoginController::class, 'providerCallback']);
Route::get('/social-auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.redirect');

Route::middleware(['auth', 'blocked', 'impersonate'])->group(function () {
//Admin route
Route::group([
    'middleware' => 'admin',
], function () {
    if(env('FORCE_ROUTE_HTTPS') == 'true'){URL::forceScheme('https');}
    Route::get('/panel/index', function(){return redirect(url('dashboard'));});
    Route::get('/admin/users', [AdminController::class, 'users'])->name('showUsers');
    Route::get('/admin/links/{id}', [AdminController::class, 'showLinksUser'])->name('showLinksUser');
    Route::get('/admin/deleteLink/{id}', [AdminController::class, 'deleteLinkUser'])->name('deleteLinkUser');
    Route::get('/admin/users/block/{block}/{id}', [AdminController::class, 'blockUser'])->name('blockUser');
    Route::get('/admin/users/verify/{verify}/{id}', [AdminController::class, 'verifyCheckUser'])->name('verifyCheckUser');
    Route::get('/admin/users/verify-mail/{verify}/{id}', [AdminController::class, 'verifyUser'])->name('verifyUser');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'showUser'])->name('showUser');
    Route::post('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::get('/admin/new-user', [AdminController::class, 'createNewUser'])->name('createNewUser')->middleware('max.users');
    Route::get('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::post('/admin/delete-table-user/{id}', [AdminController::class, 'deleteTableUser'])->name('deleteTableUser');
    Route::get('/admin/pages', [AdminController::class, 'showSitePage'])->name('showSitePage');
    Route::post('/admin/pages', [AdminController::class, 'editSitePage'])->name('editSitePage');
    Route::get('/admin/advanced-config', [AdminController::class, 'showFileEditor'])->name('showFileEditor');
    Route::post('/admin/advanced-config', [AdminController::class, 'editAC'])->name('editAC');
    Route::get('/admin/env', [AdminController::class, 'showFileEditor'])->name('showFileEditor');
    Route::post('/admin/env', [AdminController::class, 'editENV'])->name('editENV');
    Route::get('/admin/site', [AdminController::class, 'showSite'])->name('showSite');
    Route::post('/admin/site', [AdminController::class, 'editSite'])->name('editSite');
    Route::get('/admin/site/delavatar', [AdminController::class, 'delAvatar'])->name('delAvatar');
    Route::get('/admin/site/delfavicon', [AdminController::class, 'delFavicon'])->name('delFavicon');
    Route::get('/admin/phpinfo', [AdminController::class, 'phpinfo'])->name('phpinfo');
    Route::get('/admin/backups', [AdminController::class, 'showBackups'])->name('showBackups');
    Route::post('/admin/theme', [AdminController::class, 'deleteTheme'])->name('deleteTheme');
    Route::get('/admin/theme', [AdminController::class, 'showThemes'])->name('showThemes');
    Route::get('/update/theme', [AdminController::class, 'updateThemes'])->name('updateThemes');
    Route::get('/admin/config', [AdminController::class, 'showConfig'])->name('showConfig');
    Route::post('/admin/config', [AdminController::class, 'editConfig'])->name('editConfig');
    Route::get('/send-test-email', [AdminController::class, 'SendTestMail'])->name('SendTestMail');
    Route::get('/auth-as/{id}', [AdminController::class, 'authAsID'])->name('authAsID');
    Route::get('/theme-updater', function () {return view('studio/theme-updater', []);});
    Route::get('/update', function () {return view('update', []);});
    Route::get('/backup', function () {return view('backup', []);});

    Route::group(['namespace'=>'App\Http\Controllers\Admin', 'prefix'=>'admin', 'as'=>'admin'],function() {
        //Route::resource('/admin/linktype', LinkTypeController::class);
        Route::resources([
            'linktype'=>LinkTypeController::class
        ]);
    });

}); // End Admin authenticated routes
});

// Displays Maintenance Mode page
if(env('MAINTENANCE_MODE') == 'true'){
Route::get('/{any}', function () {
  return view('maintenance');
  })->where('any', '.*');
}

require __DIR__.'/auth.php';

if(config('advanced-config.custom_url_prefix') == ""){
  Route::get('/{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');
}