<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tran_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('item_name',30);
            $table->string('tran_id',15);
            $table->string('cat_id',50);
            $table->string('item_id',50);
            $table->integer('qty');
            $table->decimal('rate',8,2);
            $table->decimal('total',8,2);
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tran_detail');
    }
}
