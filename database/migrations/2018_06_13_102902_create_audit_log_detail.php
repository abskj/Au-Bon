<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditLogDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_log', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('target_field',20);
            $table->string('target_table',20);
            $table->string('prev_value',30);
            $table->string('updated_value',30);
            $table->string('user_name',15);
            $table->integer('restro_id')->unsigned();
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
        Schema::dropIfExists('audit_log');
    }
}
