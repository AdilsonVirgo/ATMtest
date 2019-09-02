<?php

use Illuminate\Database\Seeder;
use App\Models\Material;
use Faker\Factory as Faker;

class MaterialSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $material = file_get_contents(database_path() . "/scripts/material.sql");
        $statements = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $material)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }

}
