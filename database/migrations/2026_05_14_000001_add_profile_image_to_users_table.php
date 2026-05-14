<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddProfileImageToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->text('profile_image')->nullable()->after('image');
            }
        });

        DB::table('users')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->orderBy('id')
            ->chunk(100, function ($users) {
                foreach ($users as $user) {
                    $image = $user->image;
                    $decoded = json_decode($image, true);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        continue;
                    }

                    DB::table('users')
                        ->where('id', $user->id)
                        ->whereNull('profile_image')
                        ->update(['profile_image' => $image]);
                }
            });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'profile_image')) {
                $table->dropColumn('profile_image');
            }
        });
    }
}
