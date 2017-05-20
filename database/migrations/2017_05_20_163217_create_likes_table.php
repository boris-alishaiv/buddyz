<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('post_id');
            $table->integer('user_id');
            $table->enum('type', ['diligent', 'professional', 'devoted']);
            $table->enum('status', ['like', 'unlike']);
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
        Schema::dropIfExists('likes');
    }
}
