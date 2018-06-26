<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFcMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_category_master', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('cat_id',15)->unique();
            $table->string('cat_name',15);
            $table->string('type',20);
            $table->string('user_name',15);
            $table->tinyInteger('stat_flag');
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch');
            $table->foreign('user_name')->references('user_name')->on('user_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_category_master');
    }
}
