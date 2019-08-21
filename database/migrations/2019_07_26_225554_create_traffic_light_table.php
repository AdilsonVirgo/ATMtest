<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficLightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_lights', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('devices_inventory');
            $table->unsignedBigInteger('intersection_id');
            $table->foreign('intersection_id')->references('id')->on('intersections');
            $table->unsignedBigInteger('tensor_id')->nullable();
            $table->foreign('tensor_id')->references('id')->on('traffic_tensors');
            $table->unsignedBigInteger('pole_id')->nullable();
            $table->foreign('pole_id')->references('id')->on('traffic_poles');
            $table->unsignedBigInteger('regulator_id');
            $table->foreign('regulator_id')->references('id')->on('regulator_boxes');

            $table->string('code', 50)->unique();
            $table->string('brand', 50);
            $table->string('model')->nullable();
            $table->string('state');
            $table->string('picture', 50);
            $table->string('orientation', 20);
            $table->text('comment')->nullable();
            $table->string('erp_code', 50)->nullable();

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
        Schema::dropIfExists('traffic_lights');
    }
}
