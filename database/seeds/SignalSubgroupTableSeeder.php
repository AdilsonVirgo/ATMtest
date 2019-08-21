<?php

use Illuminate\Database\Seeder;
use App\Models\SignalSubgroup;
use App\Models\SignalGroup;
use App\Models\SignalColor;

class SignalSubgroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R1',
            'name' => 'Serie de prioridad de paso',
            'shape' => 'Octógono',
            'colors' => '{"0":"Rojo","1":"Blanco","2":"Negro","3":"Verde","4":"Azul","5":"Verde limón"}',
            'description' => 'Serán instaladas en las entradas a una intersección o en puntos específicos donde se requiera aplicar las reglamentaciones contenidas en estas señales.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R2',
            'name' => 'Serie de movimiento y dirección.',
            'shape' => 'Rectángulo H',
            'colors' => '{"1": "Rojo","2": "Blanco","3": "Negro","4": "Verde","5": "Azul","6": "Verde limón"}',
            'description' => 'Obligación de los conductores de circular solo en la dirección indicada por las flechas de las señales.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R3',
            'name' => 'Serie restricción de circulación.',
            'shape' => 'Cuadrado',
            'colors' => '{"1": "Rojo","2": "Blanco","3": "Negro","4": "Verde","5": "Azul","6": "Verde limón"}',
            'description' => 'Estas señales se utilizan para prohibir el ingreso y/o circulación de la clase de vehículo indicado en el símbolo.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R4',
            'name' => 'Serie de límites máximos.',
            'shape' => 'Cuadrado',
            'colors'=> '{"0": "Rojo","1": "Blanco","2": "Negro","3": "Verde","4": "Azul","5": "Verde limón"}'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R5',
            'name' => 'Series de estacionamientos.',
            'colors' => '{"0":"Rojo","1":"Blanco","2":"Negro","3":"Verde","4":"Azul","5":"Verde limón"}',
            'shape' => 'Cuadrado',
            'description' => 'Se utilizan para informar a los conductores, de las restricciones o facilidades de estacionamiento que tienen en las vías.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R6',
            'name' => 'Serie placas complementarias.',
            'shape' => 'Cuadrado',
            'colors' => '{"0":"Rojo","1":"Blanco","2":"Negro","3":"Verde","4":"Azul","5":"Verde limón"}',
            'description' => 'Estas señales son para complementar con información adicional a otras señales a través de símbolos y/o leyendas, se las debe utilizar de acuerdo a las necesidades de los mensajes regulatorios a ser implementados.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'R')->value('id'),
            'code' => 'R7',
            'name' => 'Serie misceláneas.',
            'shape' => 'Cuadrado',
            'colors' => '{"0":"Rojo","1":"Blanco","2":"Negro","3":"Verde","4":"Azul","5":"Verde limón"}',
            'description' => 'Esta señal se utiliza para indicar la prohibición de hacer uso de aparatos sonoro y/o de generar niveles de ruido elevados por medio de aceleraciones bruscas.'
        ]);
        


        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P1',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de alineamiento.',
            'description' => 'Se instalan en aproximaciones a curvas horizontales. La selección hecha depende de las velocidades de aproximación y de la geometría de la vía.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P2',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de intersecciones y empalmes.',
            'description' => 'Las señales de la serie de intersección y empalme se usan donde la distancia de visibilidad en el acceso a una intersección o empalme es menor que la distancia segura de parada o donde los conductores pueden tener dificultad para apreciar la presencia o configuración de una intersección importante situada más adelante.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P3',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de aproximación a dispositivos de control de tránsito.',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P4',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de anchos, alturas, largos y pesos.',
            'description' => 'Estas señales previenen al conductor de la existencia más adelante de limitaciones en el ancho, altura, largos y peso que tiene la calzada de circulación.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P5',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de asignación de carriles.',
            'description' => 'Estas señales previenen al conductor de la aproximación a una asignación de carriles de circulación en las vías; se utiliza símbolo y línea de color rojo en situaciones de mayor peligro.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P6',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie de obstáculos y situaciones especiales en la vía.',
            'description' => 'Estas señales previenen al conductor de la aproximación a obstáculos y situaciones especiales en las vías.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P7',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie peatonal.',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'P')->value('id'),
            'code' => 'P8',
            'shape' => 'Rectángulo H',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'name' => 'Serie complementaria.',
            'description' => 'Estas señales son para complementar con información adicional a otras señales a través de símbolos y/o leyendas, se las debe utilizar de acuerdo a las necesidades de los mensajes preventivos a ser implementados, deben ir ubicadas bajo la señal preventiva; excepto cuando se indique lo contrario.'
        ]);



        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'I')->value('id'),
            'code' => 'I1',
            'name' => 'Señales de información de Guía.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Verde","1": "Blanco"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'I')->value('id'),
            'code' => 'I2',
            'name' => 'Señales de información de Servicios.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Blanco","1": "Azul"}',
            'description' => 'Estas señales dan al conductor información previa de la presencia de los diferentes tipos de servicios que existen al borde derecho de la carretera en el sentido de circulación.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'I')->value('id'),
            'code' => 'I3',
            'name' => 'Señales de información misceláneos.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Verde","1": "Blanco"}',
            'description' => null
        ]);



        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D1',
            'name' => 'Poster delineadores.',
            'shape' => null,
            'colors' => '{"0": "Blanco","1": "Rojo"}',
            'description' => 'Los postes delineadores de vía son dispositivos retroreflectivos que facilitan el encauzamiento en la conducción nocturna y especialmente en curvas.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D1',
            'name' => 'Postes delineadores de vía.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'description' => 'Estos dispositivos definen los bordes de la vía, para indicar los límites laterales del uso seguro de la calzada, e indican el alineamiento que tiene la vía más adelante, especialmente en las curvas horizontales y verticales.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D2',
            'name' => 'Señales delineadores de peligro en curva horizontal.',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'shape' => 'Rectángulo',
            'description' => 'Los delineadores de curva horizontal se utilizan para indicar el cambio brusco de dirección en el alineamiento horizontal de una vía.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D3',
            'name' => 'Serie de anchos de vía.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D4',
            'name' => 'Serie de limite de altura.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D5',
            'name' => 'Serie obstrucciones.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D6',
            'name' => 'Serie alineamientos horizontales.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Negro","1": "Amarillo"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'D')->value('id'),
            'code' => 'D7',
            'name' => 'Serie de postes de kilometraje.',
            'shape' => 'Rectángulo',
            'colors' => '{"0": "Verde","1": "Blanco"}',
            'description' => null
        ]);



        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'E')->value('id'),
            'code' => 'E1',
            'shape' => 'Pentagonal',
            'colors' => '{"0": "Negro","1": "Verde limón"}',
            'name' => 'Serie de advertencia anticipada de zona escolar.',
            'description' => 'La señal de zona escolar previene al conductor del vehículo de la proximidad, a una zona donde se encuentran centros educativos.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'E')->value('id'),
            'code' => 'E2',
            'shape' => 'Rombo',
            'colors' => '{"0": "Negro","1": "Verde limón"}',
            'name' => 'Serie de placas complementarias.',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'E')->value('id'),
            'code' => 'ER1',
            'name' => 'Serie de control de velocidad.',
            'shape' => 'Rectángulo V',
            'colors' => '{"0": "Negro","1": "Verde limón"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'E')->value('id'),
            'code' => 'ER2',
            'name' => 'Serie de control de velocidad.',
            'shape' => 'Rectángulo V',
            'colors' => '{"0": "Blanco","1": "Azul"}',
            'description' => null
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'E')->value('id'),
            'code' => 'ER3',
            'name' => 'Serie de control de velocidad.',
            'shape' => 'Rectángulo V',
            'colors' => '{"0": "Negro","1": "Blanco"}',
            'description' => null
        ]);



        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'IT, IS, SR')->value('id'),
            'code' => 'IT1',
            'name' => 'Naturales.',
            'shape' => 'Rectángulo,Cuadrado',
            'colors' => '{"0": "Verde","1": "Azul","2": "Café"}',
            'description' => 'Se reconoce como atractivo natural los tipos de montañas, planicies, desiertos, ambientes lacustres, ríos, bosques, aguas subterráneas, fenómenos geológicos, costas o litorales, ambientes marinos, tierras insulares, sistemas de áreas protegidas, entre otros.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'IT, IS, SR')->value('id'),
            'code' => 'IT2',
            'name' => 'Culturales.',
            'shape' => 'Rectángulo,Cuadrado',
            'colors' => '{"0": "Verde","1": "Azul","2": "Café"}',
            'description' => 'Representa el conjunto de sitios y manifestaciones que se consideran de valor o aporte de una comunidad determinada y que permite al visitante conocer parte de los sucesos ocurridos en una región o país, reflejadas en obras de arquitectura, zonas históricas, sitios arqueológicos, iglesias, conventos, ect'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'IT, IS, SR')->value('id'),
            'code' => 'IS3',
            'name' => 'Actividades turísticas.',
            'shape' => 'Rectángulo,Cuadrado',
            'colors' => '{"0": "Verde","1": "Azul","2": "Café"}',
            'description' => 'Representan las actividades turísticas que se producen por la relación oferta/demanda de bienes y servicios implantados por personas naturales o jurídicas que se dediquen de modo profesional a la prestación de servicios turísticos con fines a satisfacer necesidades del visitante-turista.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'IT, IS, SR')->value('id'),
            'code' => 'IS4',
            'name' => 'De servicios y apoyo a los turisticos.',
            'shape' => 'Rectángulo,Cuadrado',
            'colors' => '{"0": "Verde","1": "Azul","2": "Café"}',
            'description' => 'Son aquellas que indican a los visitantesturistas la ubicación de servicios públicos o privados sea de salud, de comunicaciones y varios.'
        ]);

        SignalSubgroup::create([
            'group_id' => SignalGroup::where('code', 'IT, IS, SR')->value('id'),
            'code' => 'IS5',
            'name' => 'Señales turísticas o de servicios restrictivos.',
            'shape' => 'Rectángulo,Cuadrado',
            'colors' => '{"0": "Verde","1": "Azul","2": "Café"}',
            'description' => 'Representan la prohibición de realizar determinada actividad de manera temporal o definitiva de acuerdo a la necesidad o circunstancia.'
        ]);
    }
}
