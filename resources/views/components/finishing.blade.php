<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Database\Seeders\ButtonSeeder;
use App\Models\Page;
use App\Models\Link;

set_time_limit(0);

//run before finishing:
if (EnvEditor::keyExists('JOIN_BETA')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('JOIN_BETA', 'false');
} // Adds key to .env file

if (EnvEditor::keyExists('SKIP_UPDATE_BACKUP')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('SKIP_UPDATE_BACKUP', 'false');
} // Adds key to .env file

if (EnvEditor::keyExists('CUSTOM_META_TAGS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('CUSTOM_META_TAGS', 'false');
}

if (EnvEditor::keyExists('MAINTENANCE_MODE')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('MAINTENANCE_MODE', 'false');
}

if (EnvEditor::keyExists('ALLOW_CUSTOM_CODE_IN_THEMES')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ALLOW_CUSTOM_CODE_IN_THEMES', 'true');
}

if (EnvEditor::keyExists('ENABLE_THEME_UPDATER')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ENABLE_THEME_UPDATER', 'true');
}

if (EnvEditor::keyExists('ENABLE_SOCIAL_LOGIN')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ENABLE_SOCIAL_LOGIN', 'false');
}

if (EnvEditor::keyExists('USE_THEME_PREVIEW_IFRAME')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('USE_THEME_PREVIEW_IFRAME', 'true');
}

if (EnvEditor::keyExists('FORCE_ROUTE_HTTPS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('FORCE_ROUTE_HTTPS', 'false');
}

if (EnvEditor::keyExists('HIDE_VERIFICATION_CHECKMARK')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('HIDE_VERIFICATION_CHECKMARK', 'false');
}

if (EnvEditor::keyExists('ALLOW_CUSTOM_BACKGROUNDS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ALLOW_CUSTOM_BACKGROUNDS', 'true');
}

if (EnvEditor::keyExists('ALLOW_USER_IMPORT')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ALLOW_USER_IMPORT', 'true');
}

if (EnvEditor::keyExists('ALLOW_USER_EXPORT')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ALLOW_USER_EXPORT', 'true');
}

if (EnvEditor::keyExists('SUPPORTED_DOMAINS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('SUPPORTED_DOMAINS', '');
}

if (EnvEditor::keyExists('MANUAL_USER_VERIFICATION')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('MANUAL_USER_VERIFICATION', 'false');
}

if (EnvEditor::keyExists('DISPLAY_CREDIT_FOOTER')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('DISPLAY_CREDIT_FOOTER', 'true');
}

if (EnvEditor::keyExists('LOCALE')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('LOCALE', 'en');
}

if (EnvEditor::keyExists('ENABLE_REPORT_ICON')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ENABLE_REPORT_ICON', 'false');
}

if (EnvEditor::keyExists('ENABLE_ADMIN_BAR')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ENABLE_ADMIN_BAR', 'true');
}

if (EnvEditor::keyExists('ENABLE_ADMIN_BAR_USERS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('ENABLE_ADMIN_BAR_USERS', 'false');
}

if (EnvEditor::keyExists('ADMIN_EMAIL')) {
} else {
    if (Auth::user()->id == 1) {
        EnvEditor::addKey('ADMIN_EMAIL', App\Models\User::find(1)->email);
    } else {
        EnvEditor::addKey('ADMIN_EMAIL', '');
    }
}

if (env('APP_NAME') == 'LittleLink Custom' or env('APP_NAME') == 'LittleLink') {
    EnvEditor::editKey('APP_NAME', 'LinkStack');
}

if (EnvEditor::keyExists('ALLOW_REGISTRATION')) {
    /* Do nothing if key already exists */
} else {
    $pagedb = DB::table('pages')->select('register')->first();
    if ($pagedb->register) {
        EnvEditor::addKey('ALLOW_REGISTRATION', 'true');
    } else {
        EnvEditor::addKey('ALLOW_REGISTRATION', 'false');
    }
    try {
        DB::table('pages')->update(['register' => null]);
    } catch (Exception $e) {
        session(['update_error' => $e->getMessage()]);
    }
}

if (EnvEditor::keyExists('SPA_MODE')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('SPA_MODE', 'false');
}

try {
    $file = base_path('storage/RSTAC');
    if (file_exists($file)) {
        copy(base_path('storage/templates/advanced-config.php'), base_path('config/advanced-config.php'));
        unlink($file);
    }
} catch (Exception $e) {
    session(['update_error' => $e->getMessage()]);
}

try {
    $vendorLangPath = resource_path('lang/vendor');
    if (File::exists($vendorLangPath)) {
        File::deleteDirectory($vendorLangPath);
    }
} catch (Exception $e) {
    session(['update_error' => $e->getMessage()]);
}

// Footer page customization
if (EnvEditor::keyExists('DISPLAY_FOOTER_HOME')) {
} else {
    EnvEditor::addKey('DISPLAY_FOOTER_HOME', 'true');
}
if (EnvEditor::keyExists('DISPLAY_FOOTER_TERMS')) {
} else {
    EnvEditor::addKey('DISPLAY_FOOTER_TERMS', 'true');
}
if (EnvEditor::keyExists('DISPLAY_FOOTER_PRIVACY')) {
} else {
    EnvEditor::addKey('DISPLAY_FOOTER_PRIVACY', 'true');
}
if (EnvEditor::keyExists('DISPLAY_FOOTER_CONTACT')) {
} else {
    EnvEditor::addKey('DISPLAY_FOOTER_CONTACT', 'true');
}
if (EnvEditor::keyExists('TITLE_FOOTER_HOME')) {
} else {
    EnvEditor::addKey('TITLE_FOOTER_HOME', 'Home');
}
if (EnvEditor::keyExists('TITLE_FOOTER_TERMS')) {
} else {
    EnvEditor::addKey('TITLE_FOOTER_TERMS', 'Terms');
}
if (EnvEditor::keyExists('TITLE_FOOTER_PRIVACY')) {
} else {
    EnvEditor::addKey('TITLE_FOOTER_PRIVACY', 'Privacy');
}
if (EnvEditor::keyExists('TITLE_FOOTER_CONTACT')) {
} else {
    EnvEditor::addKey('TITLE_FOOTER_CONTACT', 'Contact');
}
if (EnvEditor::keyExists('HOME_FOOTER_LINK')) {
} else {
    EnvEditor::addKey('HOME_FOOTER_LINK', '');
}

if (EnvEditor::keyExists('FORCE_HTTPS')) {
    /* Do nothing if key already exists */
} else {
    EnvEditor::addKey('FORCE_HTTPS', 'false');
}

$data['page'] = Page::select('contact')->first();
if (strpos($data['page']->contact, 'info@littlelink-custom.com') !== false or strpos($data['page']->contact, 'LittleLink Custom') !== false) {
    $contact = '
            <p><strong><a href="https://linkstack.org/">LinkStack</a></strong> is a free, open source&nbsp;link&nbsp;sharing platform. We depend on community feedback to steadily improve this project.</p>
            
            <p><strong>Feel free to send us your feedback!</strong></p>
            
            <ul>
            	<li>Join our <a href="https://discord.linkstack.org/">community Discord</a></li>
            	<li>Join the <a href="https://github.com/linkstackorg/linkstack/discussions">discussion forum</a></li>
            	<li>Request a feature and add it to the <a href="https://github.com/linkstackorg/linkstack/discussions/49">to-do list</a></li>
            	<li>Write us an <a href="mailto:info@linkstack.org?subject=Inquiry%20about%20LinkStack">email</a></li>
            </ul>
            
            <p>If you&#39;re having any trouble or encountered a bug, feel free to <a href="https://github.com/linkstackorg/linkstack/issues">open an issue on GitHub</a>.</p>
            
            <p>&nbsp;</p>
            ';
    Page::first()->update(['contact' => $contact]);
}

$data['page'] = Page::select('home_message')->first();
if (strpos($data['page']->home_message, 'LittleLink Custom') !== false) {
    $home_message = '
            <p>Take control of your online presence with&nbsp;<a href="https://linkstack.org/"><strong>LinkStack</strong></a> the privacy-focused, open-source <strong>link management platform</strong>. Create a customizable profile page to manage <strong>all your important links in one convenient location</strong> and give your audience a seamless browsing experience.</p>
            ';
    Page::first()->update(['home_message' => $home_message]);
}

$migrationFiles = glob(database_path('migrations/*.php'));

$fileNames = array_map(function ($file) {
    return basename($file, '.php');
}, $migrationFiles);

foreach ($fileNames as $fileName) {
    if (!DB::table('migrations')->where('migration', $fileName)->exists()) {
        DB::table('migrations')->insert(['migration' => $fileName, 'batch' => 1]);
    }
}

/* Updates button database entries */
Schema::disableForeignKeyConstraints();
$existingMigration = '2021_03_17_044922_create_buttons_table';

try {
    if (DB::table('migrations')->where('migration', $existingMigration)->exists()) {
        DB::table('migrations')->where('migration', $existingMigration)->delete();
    }

    Schema::dropIfExists('buttons');

    $migrator = app('migrator');
    $migrator->run(database_path('migrations'));

    $seeder = new ButtonSeeder();
    $seeder->run();
} catch (exception $e) {
    session(['update_error' => $e->getMessage()]);
}
Schema::enableForeignKeyConstraints();

if (!Schema::hasColumn('users', 'auth_as')) {
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedInteger('auth_as')->nullable();
    });
}

try {
    DB::table('link_types')->updateOrInsert([
        'typename' => 'text',
        'title' => 'Text',
        'icon' => 'bi bi-fonts',
        'description' => 'Add static text to your page that is not clickable.',
        'params' => '[{
                "tag": "textarea",
                "id": "static-text",
                "for": "static_text",
                "label": "Text",
                "name": "static_text",
                "class": "form-control"
            }
            ]',
    ]);

    DB::table('link_types')->updateOrInsert([
        'typename' => 'email',
        'title' => 'E-Mail address',
        'icon' => 'bi bi-envelope-fill',
        'description' => 'Add an email that opens a system dialog to compose a new email.',
    ]);

    DB::table('link_types')->updateOrInsert([
        'typename' => 'telephone',
        'title' => 'Telephone number',
        'icon' => 'bi bi-telephone-fill',
        'description' => 'Add a telephone number that opens a system dialog to initiate a phone call.',
    ]);

    DB::table('link_types')->updateOrInsert([
        'typename' => 'vcard',
        'title' => 'Vcard',
        'icon' => 'bi bi-person-square',
        'description' => 'Create or upload an electronic business card.',
    ]);
} catch (exception $e) {
    session(['update_error' => $e->getMessage()]);
}

// Moves all previous images to the new path
try {
    if (is_dir(base_path('assets/img'))) {
        $files = File::files(base_path('img'));
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path('assets/img/' . $filename);
            if (!File::exists($destination)) {
                if (!$file->isDir()) {
                    File::move($file, $destination);
                }
            }
        }
    }
} catch (exception $e) {
}
try {
    if (is_dir(base_path('assets/img/background-img'))) {
        $files = File::files(base_path('img/background-img'));
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path('assets/img/background-img/' . $filename);
            if (!File::exists($destination)) {
                if (!$file->isDir()) {
                    File::move($file, $destination);
                }
            }
        }
    }
} catch (exception $e) {
}
try {
    if (is_dir(base_path('littlelink/images'))) {
        $files = File::files(base_path('littlelink/images'));
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path('assets/linkstack/images/' . $filename);
            if (!File::exists($destination)) {
                if (!$file->isDir()) {
                    File::move($file, $destination);
                }
            }
        }
    }
} catch (exception $e) {
}
try {
    if (is_dir(base_path('littlelink/images'))) {
        $files = File::files(base_path('littlelink/images'));
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path('assets/linkstack/images/' . $filename);
            if (!File::exists($destination)) {
                if (!$file->isDir()) {
                    File::move($file, $destination);
                }
            }
        }
    }
} catch (exception $e) {
}
try {
    if (is_dir(base_path('studio/favicon/icons'))) {
        $files = File::files(base_path('studio/favicon/icons'));
        foreach ($files as $file) {
            $filename = $file->getFilename();
            $destination = base_path('assets/favicon/icons/' . $filename);
            if (!File::exists($destination)) {
                if (!$file->isDir()) {
                    File::move($file, $destination);
                }
            }
        }
    }
} catch (exception $e) {
}

// Changes saved profile images from littlelink_name to IDs.
// This runs every time the updater runs.
// Not sure if this will cause any issues.
// If it works, I won't touch it.
try {
    $users = DB::table('users')->get();
    foreach ($users as $user) {
        $oldName = $user->littlelink_name . '.png';
        $newName = $user->id . '.png';
        $oldPath = base_path('assets/img/' . $oldName);
        $newPath = base_path('assets/img/' . $newName);

        if (File::exists($oldPath)) {
            File::move($oldPath, $newPath);
        }
    }
} catch (exception $e) {
    session(['update_error' => $e->getMessage()]);
}

try {

    $links = Link::where('button_id', 94)->get()->groupBy('user_id');

    foreach ($links as $userId => $userLinks) {
        $hasXTwitter = $userLinks->contains('title', 'x-twitter');

        foreach ($userLinks as $link) {
            if ($link->title == 'twitter') {
                if ($hasXTwitter) {
                    $link->delete();
                } else {
                    $link->title = 'x-twitter';
                    $link->save();
                    $hasXTwitter = true;
                }
            }
        }
    }

} catch (exception $e) {
session(['update_error' => $e->getMessage()]);
}

try {

    $themesPath = base_path('themes');
    $regex = '/[0-9.-]/';
    $files = scandir($themesPath);
    $files = array_diff($files, array('.', '..'));

    $themeError = 'The update was successful. Your theme-filesystem was detected as corrupted and has been reset.';

    foreach ($files as $file) {

        $basename = basename($file);
        $filePath = $themesPath . '/' . $basename;

        if (!is_dir($filePath)) {

            File::deleteDirectory($themesPath);
            mkdir($themesPath);
            session(['update_error' => $themeError]);
            break;

        }

        if (preg_match($regex, $basename)) {

            $newBasename = preg_replace($regex, '', $basename);
            $newPath = $themesPath . '/' . $newBasename;
            File::copyDirectory($filePath, $newPath);
            File::deleteDirectory($filePath);

        }

    }

} catch (exception $e) {
    session(['update_error' => $e->getMessage()]);
}

try {
    Artisan::call('view:clear');
} catch (exception $e) {
    session(['update_error' => $e->getMessage()]);
}

?>
