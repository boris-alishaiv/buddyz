<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activity', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('activity_id');
            $table->enum('status', ['pending', 'agreed', 'decline', 'transferred', 'done']);
            $table->enum('initiated_by', ['buddy', 'privateClient', 'businessClient']);
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
        Schema::dropIfExists('user_activity');
    }
}
