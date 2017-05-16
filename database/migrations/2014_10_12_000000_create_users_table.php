<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('studentID')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->boolean('isDeleted')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('profile_image');
            $table->integer('thumbs_up',11)->default(0);
            $table->integer('thumbs_down',11)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
