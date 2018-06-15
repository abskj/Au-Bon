<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tran_id',15)->unique();
            $table->bigInteger('cust_id');
            $table->decimal('bill_amount',8,2);
            $table->dateTime('date_time');
            $table->string('user_name');
            $table->decimal('discount',8,2);
            $table->decimal('net_billed',8,2);
            $table->integer('branch_id')->unsigned();
            $table->foreign('user_name')->references('user_name')->on('user_login');
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
        Schema::dropIfExists('bill_transaction');
    }
}
