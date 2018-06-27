<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_master', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('cat_id');
            $table->string('item_id',15)->unique();
            $table->string('HSN_code',10);
            $table->integer('SGST');
            $table->integer('CGST');
            $table->string('item_name',30);
            $table->decimal('item_rate',8,2);
            $table->string('user_name',15);
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
        Schema::dropIfExists('item_master');
    }
}
