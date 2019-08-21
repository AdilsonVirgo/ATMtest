<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignalVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signal_variations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('signal_id');
            $table->foreign('signal_id')->references('id')->on('signals_inventory');

            $table->string('variation');

            $table->unsignedBigInteger('dimension_id');
            $table->foreign('dimension_id')->references('id')->on('signal_dimensions');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signal_variations');
    }
}
