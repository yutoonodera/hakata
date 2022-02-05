<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            //$table->unsignedBigInteger('user_id')->unsigned;
            $table->string('movie_file', 255);
            $table->string('thumbnail_file', 255)->nullable();
            $table->integer('status')->default(0);
            $table->string('title', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('minutes')->nullable();
            $table->string('product1', 255)->nullable();
            $table->integer('price1')->nullable();
            $table->string('product2', 255)->nullable();
            $table->integer('price2')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
