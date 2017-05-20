<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('type', ['postVideo', 'postImage', 'skillImage', 'skillVideo', 'activityImage', 'activityVideo']);
            $table->string('url');
            $table->integer('user_category_id')->nullable();
            $table->integer('activity_id')->nullable();
            $table->integer('post_id')->nullable();
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
        Schema::dropIfExists('media');
    }
}
