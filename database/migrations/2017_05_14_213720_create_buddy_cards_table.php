<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuddyCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buddy_cards', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('description');
            $table->integer('price');
            $table->text('schedule');
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
        Schema::dropIfExists('buddy_cards');
    }
}
