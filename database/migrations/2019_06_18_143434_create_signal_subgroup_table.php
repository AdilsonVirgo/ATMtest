<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignalSubgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signal_subgroups', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('signal_groups')->onDelete('cascade');

            $table->string('code');
            $table->string('name');
            $table->string("shape")->nullable();
            $table->string("colors")->nullable();
            $table->text('description')->nullable();
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
        Schema::table('signal_subgroups', function(Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
        Schema::dropIfExists('signal_subgroups');
    }
}
