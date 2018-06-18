<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_login', function (Blueprint $table) {

            $table->timestamps();
            $table->string('user_name',15)->unique();
            $table->string('password',100);
            $table->string('user_fname',50)->nullable();
            $table->string('address',200)->nullable();
            $table->integer('restro_id')->unsigned()->nullable();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->bigInteger('aadhar_no')->unique();
            $table->bigInteger('voter_card_no')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('role');
            $table->foreign('restro_id')->references('id')->on('restro');
            $table->foreign('branch_id')->references('id')->on('branch');
            $table->primary('user_name');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_login');
    }
}
