<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    var $TableName = 'link_types';
    public function up()
    {
        DB::table($this->TableName)->updateOrInsert([
            'typename' => 'xmpp',
            'title' => 'xmpp',
            'icon' => 'fa fa-xmpp',
            'description' => 'Add a xmpp address that opens a system dialog'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
