<?php

use Illuminate\Database\Seeder;

class DevicesInventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = file_get_contents(database_path() . "/scripts/devices_inventory.sql");
        $statements = array_filter(array_map('trim', preg_split( '/\r\n|\r|\n/', $devices)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
