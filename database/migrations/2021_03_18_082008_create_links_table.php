<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->text('link');
            $table->string('title');
            $table->string('type')->nullable();
            $table->text('type_params')->nullable();
            $table->integer('order')->default(0);
            $table->integer('click_number')->default(0);
            $table->enum('up_link', ['yes', 'no'])->default('no');
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('button_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('button_id')->references('id')->on('buttons');
            $table->timestamps();
            $table->string('custom_css')->default('');
            $table->string('custom_icon')->default('fa-external-link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
    }
}
