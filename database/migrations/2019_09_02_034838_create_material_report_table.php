<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialReportTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('material_report', function (Blueprint $table) {
            $table->primary(['material_id','report_id']);
            $table->unsignedBigInteger('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unsignedBigInteger('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->unsignedBigInteger('cantidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('material_report');
    }

}
