<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->string('erp_code', 50)->nullable();
            $table->string('name');   
            $table->integer('quantity');        
            $table->unsignedBigInteger('report_id')->references('id')->on('reports');
            $table->boolean('origen')->default(true);     //1-stock(predefinido) o false- almacen         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
