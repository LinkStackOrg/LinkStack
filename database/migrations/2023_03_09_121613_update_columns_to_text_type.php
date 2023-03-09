<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsToTextType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('littlelink_description')->nullable()->change();
        });

        Schema::table('links', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });

        // Set the new character limit to 1000 for both columns
        DB::statement('ALTER TABLE users MODIFY COLUMN littlelink_description TEXT(1000)');
        DB::statement('ALTER TABLE links MODIFY COLUMN title TEXT(1000)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('littlelink_description', 255)->nullable()->change();
        });

        Schema::table('links', function (Blueprint $table) {
            $table->string('title', 255)->nullable()->change();
        });

        // Revert the character limit to 255 for both columns
        DB::statement('ALTER TABLE users MODIFY COLUMN littlelink_description VARCHAR(255)');
        DB::statement('ALTER TABLE links MODIFY COLUMN title VARCHAR(255)');
    }
}
