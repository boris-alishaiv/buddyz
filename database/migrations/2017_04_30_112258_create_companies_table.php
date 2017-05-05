<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('company_number');
            $table->string('name');
            $table->string('location');
            $table->string('info');
            $table->enum('type', ["organization", "non-profit organization", "institute", "company", "small business"]);
            $table->string('facebook_url');
            $table->string('linkedIn_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
