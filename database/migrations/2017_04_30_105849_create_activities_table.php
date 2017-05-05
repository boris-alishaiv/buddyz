<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table)
        {
            $table->increments('id');
            $table->enum('type', ['job', 'event', 'volunteering']);
            $table->integer('user_id');
            $table->integer('category_id');
            $table->dateTime('time');
            $table->string('description');
            $table->integer('price');
            $table->string('location');
            $table->integer('number_of_buddyz_refusals');
            $table->enum('status', ['pending', 'agreed', 'decline', 'transferred', 'done']);
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
        Schema::dropIfExists('activities');
    }
}
