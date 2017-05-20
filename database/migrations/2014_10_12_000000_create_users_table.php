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
            $table->enum('type', ['admin', 'communityManager', 'businessClient', 'privateClient', 'buddy']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profile_picture')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female ']);
            $table->string('about')->nullable();
            $table->string('address')->nullable();
            $table->string('school')->nullable();
            $table->string('city');
            $table->integer('area_id');
            $table->string('password');
            $table->integer('score')->default(0);
            $table->enum('privacy', ['public', 'private '])->default("public");
            $table->enum('level', ['basic', 'premium', 'gold'])->default("basic");
            $table->string('actual_id')->nullable();
            $table->integer('verification')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->string('account_type')->default("normal");
            $table->string('sns_acc_id')->nullable();
            $table->enum('status_in_table', ['active', 'edited', 'deleted'])->default("active");
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
