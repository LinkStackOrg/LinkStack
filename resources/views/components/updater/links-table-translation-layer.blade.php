<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Link;

// First, check if the 'type' and 'type_params' columns exist, and add them if they don't
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

// Disable execution time limit
set_time_limit(0);

// Check version
if (trim(file_get_contents(base_path("version.json"))) < '4.8.1') {
    // Get all links
    $links = Link::all();

    foreach ($links as $link) {
        $type = null;

        // Assign type based on button_id
        switch ($link->button_id) {
            case "1":
            case "2":
                $type = "link";
                break;
            case "43":
                $type = "spacer";
                break;
            case "42":
                $type = "heading";
                break;
            case "93":
                $type = "text";
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

        // Update the link if a type was assigned
        if ($type !== null) {
            $link->type = $type;
            $link->save();
        }
    }
}