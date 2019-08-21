<?php

use Illuminate\Database\Seeder;
use App\Models\SignalGroup;

class SignalGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SignalGroup::create([
            'code' => 'R',
            'name' => 'Regulatorias',
            'description' => 'Regulan el movimiento del tránsito e indican cuando se aplica un requerimiento legal, la falta del cumplimiento de sus instrucciones constituye una infracción de tránsito.'
        ]);
        SignalGroup::create([
            'code' => 'P',
            'name' => 'Preventivas',
            'description' => 'Se utilizan para alertar a los conductores de peligros potenciales que se encuentran más adelante.'
        ]);
        SignalGroup::create([
            'code' => 'I',
            'name' => 'Informativas',
            'description' => 'Tienen como propósito orientar y guiar a los usuarios viales, proporcionándole la información necesaria para que puedan llegar a sus destinos de la forma más segura, simple y directa posible.'
        ]);
        SignalGroup::create([
            'code' => 'D',
            'name' => 'Especiales',
            'description' => 'Advierten e informan a los usuarios de las vías de la aproximación a un centro educativo y las prioridades en el uso de las mismas, así como las prohibiciones, restricciones, obligaciones y autorizaciones existentes, cuyo incumplimiento se considera una infracción a las leyes y reglamentos de tránsito.'
        ]);
        SignalGroup::create([
            'code' => 'E',
            'name' => 'Escolares',
            'description' => 'Advierten e informan a los usuarios de las vías de la aproximación a un centro educativo y las prioridades en el uso de las mismas, así como las prohibiciones, restricciones, obligaciones y autorizaciones existentes, cuyo incumplimiento se considera una infracción a las leyes y reglamentos de tránsito.'
        ]);
        SignalGroup::create([
            'code' => 'IT, IS, SR',
            'name' => 'Turísticas y servicios',
            'description' => 'Son aquellas que sirven para dirigir al conductor o transeúnte a lo largo de su itinerario, proporcionándole información sobre direcciones, sitios de interés y destino turístico, servicios y distancias.'
        ]);
    }
}
