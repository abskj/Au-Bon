<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stewards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('branch_id')->unsigned();
            $table->string('name',50);
            $table->bigInteger('mobile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stewards');
    }
}
