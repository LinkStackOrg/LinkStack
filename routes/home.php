<?php
use App\Http\Controllers\UserController;

Route::middleware('disableCookies')->group(function () {

$host = request()->getHost();
$customConfigs = config('advanced-config.custom_domains', []);

foreach ($customConfigs as $config) {
    if ($host == $config['domain']) {
    $routeCallback = function () use ($config) {
        $request = app('request');
        $request->merge(['littlelink' => isset($config['name']) ? $config['name'] : $config['id']]);
        if (isset($config['id'])) {
            $request->merge(['useif' => 'true']);
        }
        return app(UserController::class)->littlelink($request);
    };

    Route::get('/', $routeCallback)->name('littlelink');

    return;
    }
}

$customHomeUrl = config('advanced-config.custom_home_url', '/home');
$disableHomePageConfig = config('advanced-config.disable_home_page');
$redirectHomePageConfig = config('advanced-config.redirect_home_page');

if (env('HOME_URL') != '') {
    Route::get('/', [UserController::class, 'littlelinkhome'])->name('littlelink');
    if ($disableHomePageConfig == 'redirect') {
        Route::get($customHomeUrl, function () use ($redirectHomePageConfig) {
            return redirect($redirectHomePageConfig);
        });
    } elseif ($disableHomePageConfig != 'true') {
        Route::get($customHomeUrl, [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    }
} else {
    if ($disableHomePageConfig == 'redirect') {
        Route::get('/', function () use ($redirectHomePageConfig) {
            return redirect($redirectHomePageConfig);
        });
    } elseif ($disableHomePageConfig != 'true') {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    }
}

});