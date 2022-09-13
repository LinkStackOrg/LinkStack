<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


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
 if(EnvEditor::getKey('APP_KEY')==''){Artisan::call('key:generate');}

 // copies template meta config if none is present
 if(!file_exists(base_path("config/advanced-config.php"))){copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php'));}
}

// Disables routes if in Maintenance Mode
if(env('MAINTENANCE_MODE') != 'true' and !file_exists(base_path("storage/MAINTENANCE"))){

//Changes the homepage to a LittleLink Custom profile if set in the config
if(config('advanced-config.custom_home_url') != '') {
  $custom_home_page_url = config('advanced-config.custom_home_url');
} else {
  $custom_home_page_url = "/home";
}
if(env('HOME_URL') != '') {
  Route::get('/', [UserController::class, 'littlelinkhome'])->name('littlelink');
  if(config('advanced-config.disable_home_page') == 'redirect') {
    Route::get($custom_home_page_url, function () {return redirect(config('advanced-config.redirect_home_page'));});
  }elseif(config('advanced-config.disable_home_page') != 'true') {
  Route::get( $custom_home_page_url, [App\Http\Controllers\HomeController::class, 'home'])->name('home');}
} else {
  if(config('advanced-config.disable_home_page') == 'redirect') {
    Route::get('/', function () {return redirect(config('advanced-config.redirect_home_page'));});
  }elseif(config('advanced-config.disable_home_page') != 'true') {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');}
}

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
Route::get('/going/{id?}/{link?}', [UserController::class, 'clickNumber'])->where('link', '.*')->name('clickNumber');
Route::get('/' . $custom_prefix . '{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');
Route::get('/@{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');
Route::get('/pages/{name}', [AdminController::class, 'pages'])->name('pages');
Route::get('/theme/@{littlelink}', [UserController::class, 'theme'])->name('theme');

//User route
Route::group([
    'middleware' => env('REGISTER_AUTH'),
], function () {
if(env('FORCE_HTTPS') == 'true'){URL::forceScheme('https');}
if(isset($_COOKIE['LinkCount'])){if($_COOKIE['LinkCount'] == '20'){$LinkPage = 'showLinks20';}elseif($_COOKIE['LinkCount'] == '30'){$LinkPage = 'showLinks30';}elseif($_COOKIE['LinkCount'] == 'all'){$LinkPage = 'showLinksAll';} else {$LinkPage = 'showLinks';}} else {$LinkPage = 'showLinks';} //Shows correct link number
Route::get('/studio/index', [UserController::class, 'index'])->name('studioIndex');
Route::get('/studio/add-link', [UserController::class, 'showButtons'])->name('showButtons');
Route::post('/studio/sort-link', [UserController::class, 'sortLinks'])->name('sortLinks');
Route::post('/studio/add-link', [UserController::class, 'addLink'])->name('addLink');
Route::get('/studio/links', [UserController::class, $LinkPage])->name($LinkPage);
Route::get('/studio/links/10', [UserController::class, 'showLinks'])->name('showLinks');
Route::get('/studio/links/20', [UserController::class, 'showLinks20'])->name('showLinks20');
Route::get('/studio/links/30', [UserController::class, 'showLinks30'])->name('showLinks30');
Route::get('/studio/links/all', [UserController::class, 'showLinksAll'])->name('showLinksAll');
Route::get('/studio/theme', [UserController::class, 'showTheme'])->name('showTheme');
Route::post('/studio/theme', [UserController::class, 'editTheme'])->name('editTheme');
Route::get('/deleteLink/{id}', [UserController::class, 'deleteLink'])->name('deleteLink');
Route::get('/upLink/{up}/{id}', [UserController::class, 'upLink'])->name('upLink');
Route::get('/studio/edit-link/{id}', [UserController::class, 'showLink'])->name('showLink');
Route::post('/studio/edit-link/{id}', [UserController::class, 'editLink'])->name('editLink');
Route::get('/studio/button-editor/{id}', [UserController::class, 'showCSS'])->name('showCSS');
Route::post('/studio/button-editor/{id}', [UserController::class, 'editCSS'])->name('editCSS');
Route::get('/studio/page', [UserController::class, 'showPage'])->name('showPage');
Route::get('/studio/no_page_name', [UserController::class, 'showPage'])->name('showPage');
Route::post('/studio/page', [UserController::class, 'editPage'])->name('editPage');
Route::get('/studio/profile', [UserController::class, 'showProfile'])->name('showProfile');
Route::post('/studio/profile', [UserController::class, 'editProfile'])->name('editProfile');
});

}

//Admin route
Route::group([
    'middleware' => 'admin',
], function () {
if(env('FORCE_HTTPS') == 'true'){URL::forceScheme('https');}
Route::get('/panel/index', [AdminController::class, 'index'])->name('panelIndex');
Route::get('/panel/users/{type}', [AdminController::class, 'users'])->name('showUsers');
Route::post('/panel/users/{name?}', [AdminController::class, 'searchUser'])->name('searchUser');
Route::get('/panel/links/{id}', [AdminController::class, 'showLinksUser'])->name('showLinksUser');
Route::get('/panel/deleteLink/{id}', [AdminController::class, 'deleteLinkUser'])->name('deleteLinkUser');
Route::get('/panel/users/block/{block}/{id}', [AdminController::class, 'blockUser'])->name('blockUser');
Route::get('/panel/users/verify/-{verify}/{id}', [AdminController::class, 'verifyUser'])->name('verifyUser');
Route::get('/panel/edit-user/{id}', [AdminController::class, 'showUser'])->name('showUser');
Route::post('/panel/edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
Route::get('/panel/new-user', [AdminController::class, 'createNewUser'])->name('createNewUser');
Route::get('/panel/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::get('/panel/pages', [AdminController::class, 'showSitePage'])->name('showSitePage');
Route::post('/panel/pages', [AdminController::class, 'editSitePage'])->name('editSitePage');
Route::get('/panel/advanced-config', [AdminController::class, 'showFileEditor'])->name('showFileEditor');
Route::post('/panel/advanced-config', [AdminController::class, 'editAC'])->name('editAC');
Route::get('/panel/env', [AdminController::class, 'showFileEditor'])->name('showFileEditor');
Route::post('/panel/env', [AdminController::class, 'editENV'])->name('editENV');
Route::get('/panel/site', [AdminController::class, 'showSite'])->name('showSite');
Route::post('/panel/site', [AdminController::class, 'editSite'])->name('editSite');
Route::get('/panel/phpinfo', [AdminController::class, 'phpinfo'])->name('phpinfo');
Route::get('/panel/backups', [AdminController::class, 'showBackups'])->name('showBackups');
Route::post('/panel/theme', [AdminController::class, 'deleteTheme'])->name('deleteTheme');
Route::get('/panel/theme', [AdminController::class, 'showThemes'])->name('showThemes');
Route::get('/update/theme', [AdminController::class, 'updateThemes'])->name('updateThemes');
Route::get('/update', function () {return view('update', []);});
Route::get('/backup', function () {return view('backup', []);});

Route::get('/updating', function (\Codedge\Updater\UpdaterManager $updater) {

  // Check if new version is available
  if($updater->source()->isNewVersionAvailable() and (file_exists(base_path("backups/CANUPDATE")) or env('SKIP_UPDATE_BACKUP') == true)) {

      $tst = base_path('storage/');
      file_put_contents($tst.'MAINTENANCE', '');

      // Get the current installed version
      echo $updater->source()->getVersionInstalled();

      // Get the new version available
      $versionAvailable = $updater->source()->getVersionAvailable();

      // Create a release
      $release = $updater->source()->fetch($versionAvailable);

      // Run the update process
      $updater->source()->update($release);

      if(env('SKIP_UPDATE_BACKUP') != true) {unlink(base_path("backups/CANUPDATE"));}

      echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "/../update?finishing\" />";

  } else {
    echo "<meta http-equiv=\"refresh\" content=\"0; " . url()->current() . "/../update?error\" />";
  }

});

});

// Displays Maintenance Mode page
if(env('MAINTENANCE_MODE') == 'true' or file_exists(base_path("storage/MAINTENANCE"))){
Route::get('/{any}', function () {
  return view('maintenance');
  })->where('any', '.*');
}

require __DIR__.'/auth.php';
