<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGreetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasonal_greetings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('restro_id')->unsigned();
            $table->string('message_header',50);
            $table->string('message_txt',200);
            $table->foreign('restro_id')->references('id')->on('restro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasonal_greetings');
    }
}
