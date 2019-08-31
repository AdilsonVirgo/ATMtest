<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('alert_id')->references('id')->on('alerts');
            $table->unsignedBigInteger('status_id')->references('id')->on('status');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->unsignedBigInteger('assign_id')->references('id')->on('users')->nullable();            
            $table->unsignedBigInteger('material_id')->references('id')->on('materials')->nullable();
            $table->string('description')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('reports');
    }

}
