<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration {

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
            $table->string('name');
            $table->string('type')->nullable();
            $table->integer('creator_id');
            $table->string('dimensions')->nullable();
            $table->string('filename')->nullable();
            $table->float('file_size', 20, 0)->nullable();
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
        Schema::drop('media');
    }

}
