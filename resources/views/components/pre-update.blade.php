<?php // Runs before updating
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Link;

$minPhpVersion = '8.1.0';

set_time_limit(0);

if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {

    session(['update_error' => "This update requires at least PHP version $minPhpVersion. Your current PHP version is " . PHP_VERSION]);
    echo "<meta http-equiv='refresh' content='0;" . url()->current() . "/?error' />";

} else {

    try {
    if(!isset($preUpdateServer)){$preUpdateServer = 'https://pre-update.linkstack.org/';}
    $file = Http::timeout(10)->get($preUpdateServer . 'update')->body();
    file_put_contents(base_path('resources\views\update.blade.php'), $file);
} catch (Exception $e) {}

if(trim(file_get_contents(base_path("version.json"))) < '4.0.0'){
  try {
    $file = base_path('storage/RSTAC');
    if (!file_exists($file)) {
        $handleFile = fopen($file, 'w');
        fclose($handleFile);
    }
} catch (Exception $e) {}
}

if (trim(file_get_contents(base_path("version.json"))) < '4.8.1') {

if (!Schema::hasColumn('links', 'type')) {
    Schema::table('links', function (Blueprint $table) {
        $table->string('type')->nullable();
    });
}

if (!Schema::hasColumn('links', 'type_params')) {
    Schema::table('links', function (Blueprint $table) {
        $table->text('type_params')->nullable();
    });
}

    $links = Link::all();

    foreach ($links as $link) {
    $type = null;
    $params = false;

    switch ($link->button_id) {
        case "1":
            $type = "link";
            break;
        case "2":
            $type = "link";
            break;
        case "43":
            $type = "spacer";
            $params = true;
            break;
        case "42":
            $type = "heading";
            $params = true;
            break;
        case "93":
            $type = "text";
            $params = true;
            break;
        case "44":
            $type = "telephone";
            break;
        case "6":
            $type = "email";
            break;
        case "96":
            $type = "vcard";
            break;
    }

    if ($type !== null) {
        $link->type = $type;
        if ($params === true) {
            $link->type_params = json_encode(["custom_html" => true]);
        }
        $link->save();
    }
}
}

}