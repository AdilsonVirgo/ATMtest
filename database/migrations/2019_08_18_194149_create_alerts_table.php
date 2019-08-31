<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('place');
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('priority_id')->references('id')->on('priority');
            $table->unsignedBigInteger('status_id')->references('id')->on('status');
            $table->unsignedBigInteger('motive_id')->references('id')->on('motive');
            $table->text('description');            
            $table->unsignedBigInteger('device_id')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('alerts');
    }

}