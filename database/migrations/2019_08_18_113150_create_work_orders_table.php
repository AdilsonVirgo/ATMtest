<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
       //     $table->date('report_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('state');
            
            //averia,dano , necesidad reparacion,mantenimiento
            //tipop equipo, senal o semaforo
            //ref a un user tecnico escalera o algo asi
            //crcear unos requerimientros
            //prioridad,motivo,lugar,detalles todo esto del requerimiento
            //asignar escalero o tgecnico de acuerdo al dano , al parecer son dos usuarios diferente
            //se geenera una notificacion o algo asi dependiendo de a quien fue asignado con un PENDIENTE 
            //en el requerimiento ahora creado
            //[uede ser tambien ELABORADA o PEDIENTE
            //al tecnico ahora le llaman operador
            //al requerimiento le llaman orden de trabajo de requerimiento
            
            $table->timestamps();            
            $table->softDeletes();
        });
        /*{{ $total_vsignals }}
{{$total_intersections }}
{{ $total_rboxes }}
{{ $total_poles }}
{{ $total_tensors }}
{{ $total_lights }}*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}
