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
            $table->dateTime('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female ']);
            $table->string('address');
            $table->string('city');
            $table->string('areaId')->default("");
            $table->string('password');
            $table->integer('score')->nullable();
            $table->enum('privacy', ['public', 'private '])->nullable();
            $table->enum('level', ['basic', 'premium', 'gold'])->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('account_type')->default("normal");
            $table->string('sns_acc_id')->nullable();
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
