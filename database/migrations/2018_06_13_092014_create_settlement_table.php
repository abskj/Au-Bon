<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlement', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('trans_id',15)->unique();
            $table->bigInteger('customer_id');
            $table->decimal('bill_amount',8,2);
            $table->tinyInteger('settle_mode');
            $table->tinyInteger('status_flag');
            $table->bigInteger('card_number');
            $table->string('bank',30);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlement');
    }
}
