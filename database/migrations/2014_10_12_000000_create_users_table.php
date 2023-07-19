<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('littlelink_name')->unique()->nullable();
            $table->string('littlelink_description')->nullable();
            $table->enum('role', ['user', 'vip', 'admin'])->default('user');
            $table->enum('block', ['yes', 'no'])->default('no');
            $table->rememberToken();
            $table->timestamps();
            $table->string('theme')->nullable();
            $table->unsignedInteger('auth_as')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
