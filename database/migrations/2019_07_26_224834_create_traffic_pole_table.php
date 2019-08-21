<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficPoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_poles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('intersection_id');
            $table->foreign('intersection_id')->references('id')->on('intersections');

            $table->string('code', 50)->unique();
            $table->string('state');
            $table->boolean('atm_own')->nullable()->default(0);
            $table->double('height')->default(0);
            $table->string('material');
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('google_address')->nullable();
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
        Schema::dropIfExists('traffic_poles');
    }
}
