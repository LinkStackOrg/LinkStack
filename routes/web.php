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

//Redirect if no page URL is set
Route::get('/@', function () {
    return redirect('/studio/no_page_name');
});

//Public route
Route::get('/going/{id?}/{link?}', [UserController::class, 'clickNumber'])->where('link', '.*')->name('clickNumber');
Route::get('/+{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');
Route::get('/@{littlelink}', [UserController::class, 'littlelink'])->name('littlelink');
Route::get('/pages/{name}', [AdminController::class, 'pages'])->name('pages');
Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

//User route
Route::group([
    'middleware' => env('REGISTER_AUTH'),
], function () {
URL::forceScheme('https'); # comment to disable https
Route::get('/studio/index', [UserController::class, 'index'])->name('studioIndex');
Route::get('/studio/add-link', [UserController::class, 'showButtons'])->name('showButtons');
Route::post('/studio/add-link', [UserController::class, 'addLink'])->name('addLink');
Route::get('/studio/links', [UserController::class, 'showLinks'])->name('showLinks');
Route::get('/deleteLink/{id}', [UserController::class, 'deleteLink'])->name('deleteLink');
Route::get('/upLink/{up}/{id}', [UserController::class, 'upLink'])->name('upLink');
Route::get('/studio/edit-link/{id}', [UserController::class, 'showLink'])->name('showLink');
Route::post('/studio/edit-link/{id}', [UserController::class, 'editLink'])->name('editLink');
Route::get('/studio/page', [UserController::class, 'showPage'])->name('showPage');
Route::get('/studio/no_page_name', [UserController::class, 'showPage'])->name('showPage');
Route::post('/studio/page', [UserController::class, 'editPage'])->name('editPage');
Route::get('/studio/profile', [UserController::class, 'showProfile'])->name('showProfile');
Route::post('/studio/profile', [UserController::class, 'editProfile'])->name('editProfile');
});

//Admin route
Route::group([
    'middleware' => 'admin',
], function () {
URL::forceScheme('https'); # comment to disable https
Route::get('/panel/index', [AdminController::class, 'index'])->name('panelIndex');
Route::get('/panel/users/{type}', [AdminController::class, 'users'])->name('showUsers');
Route::post('/panel/users/{name?}', [AdminController::class, 'searchUser'])->name('searchUser');
Route::get('/panel/users/block/{block}/{id}', [AdminController::class, 'blockUser'])->name('blockUser');
Route::get('/panel/edit-user/{id}', [AdminController::class, 'showUser'])->name('showUser');
Route::post('/panel/edit-user/{id}', [AdminController::class, 'editUser'])->name('editUser');
Route::get('/panel/pages', [AdminController::class, 'showSitePage'])->name('showSitePage');
Route::post('/panel/pages', [AdminController::class, 'editSitePage'])->name('editSitePage');
Route::get('/panel/site', [AdminController::class, 'showSite'])->name('showSite');
Route::post('/panel/site', [AdminController::class, 'editSite'])->name('editSite');
});

require __DIR__.'/auth.php';
