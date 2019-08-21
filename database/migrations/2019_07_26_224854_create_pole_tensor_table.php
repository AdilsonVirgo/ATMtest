<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoleTensorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pole_tensor', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tensor_id');
            $table->foreign('tensor_id')->references('id')->on('traffic_tensors');
            $table->unsignedBigInteger('pole_id');
            $table->foreign('pole_id')->references('id')->on('traffic_poles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pole_tensor');
    }
}
