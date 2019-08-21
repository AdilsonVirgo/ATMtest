<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerticalSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vertical_signals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('signal_id');
            $table->foreign('signal_id')->references('id')->on('signals_inventory');

            $table->string('code', 50)->unique();
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('picture');
            $table->text('comment')->nullable();
            $table->string('orientation', 20);
            $table->text('google_address');
            $table->string("street1")->nullable();
            $table->string("street2")->nullable();
            $table->string("neighborhood")->nullable();
            $table->string("parish")->nullable();
            $table->string("state");
            $table->string("normative");
            $table->string("fastener");
            $table->string("material");
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
        Schema::dropIfExists('vertical_signals');
    }
}
