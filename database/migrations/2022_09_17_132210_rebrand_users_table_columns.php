<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RebrandUsersTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('littlelink_description', 'arcanelink_description');
            $table->renameColumn('littlelink_name', 'arcanelink_name');
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
            $table->renameColumn('arcanelink_description', 'littlelink_description');
            $table->renameColumn('arcanelink_name', 'littlelink_name');
        });
    }
}
