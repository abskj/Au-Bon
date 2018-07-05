<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restro', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->tinyInteger('gst_comp');//1 if GST is included in rate and 0 otherwise
            $table->string('restro_name',50);
            $table->string('gstin',15);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restro');
    }
}
