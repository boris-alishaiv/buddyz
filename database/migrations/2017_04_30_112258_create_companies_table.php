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
            $table->string('logo')->nullable();
            $table->string('location');
            $table->string('info');
            $table->enum('type', ["organization", "non-profit organization", "institute", "company", "small business"])
                ->default("company");
            $table->string('facebook_url')->nullable();
            $table->string('linkedIn_url')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
