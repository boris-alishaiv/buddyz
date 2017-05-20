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
            $table->enum('type', ['job', 'event', 'volunteering'])->default("job");
            $table->integer('user_id');
            $table->integer('category_id');
            $table->dateTime('time');
            $table->string('title')->nullable();
            $table->string('body');
            $table->string('image')->nullable();
            $table->integer('price')->default(0);
            $table->string('location');
            $table->enum('status', ['pending', 'agreed', 'decline', 'transferred', 'done'])->default("pending");
            $table->integer('number_of_buddyz_refusals')->default(0);
            $table->integer('number_of_views')->default(0);
            $table->integer('number_of_participants')->default(0);
            $table->integer('max_participants')->default(1);
            $table->enum('permission', ['public', 'private'])->default("public");
            $table->enum('status_in_table', ['active', 'edited', 'deleted'])->default("active");
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
