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
            $table->enum('type', ['profileImage', 'skillImage', 'skillVideo', 'companyLogo', 'activityImage', 'activityVideo', 'postImage', 'postVideo']);
            $table->string('url');
            $table->integer('user_category_id');
            $table->integer('activity_id');
            $table->integer('post_id');
            $table->integer('company_id');
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
