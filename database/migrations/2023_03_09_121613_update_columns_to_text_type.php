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
            $table->text('littlelink_description')->change();
        });

        Schema::table('links', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('link')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('littlelink_description', 255)->change();
        });

        Schema::table('links', function (Blueprint $table) {
            $table->string('title', 255)->change();
            $table->dropColumn('link', 255)->change();
        });
    }
}
