<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignalsInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signals_inventory', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('subgroup_id');
            $table->foreign('subgroup_id')->references('id')->on('signal_subgroups');

            $table->string('code', 50)->unique();
            $table->string('name');
            $table->text('usage')->nullable();
            $table->text('description')->comment('Color combination')->nullable();
            $table->string('picture');
            $table->string('picture_fn')->nullable();
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
        /*Schema::table('signals_inventory', function(Blueprint $table) {
            $table->dropForeign(['subgroup_id']);
        });*/

        /*Schema::table('vertical_signals', function(Blueprint $table) {
            $table->dropForeign(['signal_id']);
        });*/
        Schema::dropIfExists('signals_inventory');
    }
}
