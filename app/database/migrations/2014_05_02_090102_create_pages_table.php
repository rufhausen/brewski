<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('creator_id');
            $table->string('status')->default('draft');
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('slug')->nullable();
            $table->string('layout')->default('default');
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
        Schema::drop('pages');
    }

}
