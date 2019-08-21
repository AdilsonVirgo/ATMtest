<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_devices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('traffictensor_id');
            $table->foreign('traffictensor_id')->references('id')->on('traffic_tensors');
            $table->unsignedBigInteger('trafficpole_id');
            $table->foreign('trafficpole_id')->references('id')->on('traffic_poles');
            $table->unsignedBigInteger('regulatorbox_id');
            $table->foreign('regulatorbox_id')->references('id')->on('regulator_boxes');
            $table->unsignedBigInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices_inventory');

            $table->string('code', 50)->unique();
            $table->string('status');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->text('comment')->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('traffic_devices');
    }
}
