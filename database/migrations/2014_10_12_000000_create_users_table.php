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
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('date_of_birth');
            $table->enum('gender', ['male', 'female ']);
            $table->string('address');
            $table->string('city');
            $table->string('areaId');
            $table->string('password');
            $table->integer('score');
            $table->enum('privacy', ['public', 'private ']);
            $table->enum('level', ['basic', 'premium', 'gold']);
            $table->rememberToken();
            $table->timestamps();
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
