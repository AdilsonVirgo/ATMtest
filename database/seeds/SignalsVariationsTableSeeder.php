<?php

use Illuminate\Database\Seeder;

class SignalsVariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $signals = file_get_contents(database_path() . "/scripts/signals_variations.sql");
        $statements = array_filter(array_map('trim', preg_split( '/\r\n|\r|\n/', $signals)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
