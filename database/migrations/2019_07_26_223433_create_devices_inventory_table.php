<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices_inventory', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('code', 50)->unique()->nullable();
            $table->string('name');
            $table->string('symbol', 50)->nullable();
            $table->string('dimensions', 50)->nullable();
            $table->string('brand', 50)->nullable();
            $table->text('options')->nullable();
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
        Schema::dropIfExists('devices_inventory');
    }
}
