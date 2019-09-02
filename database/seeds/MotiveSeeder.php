<?php

use Illuminate\Database\Seeder;
use App\Models\Motive;

class MotiveSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $motive = file_get_contents(database_path() . "/scripts/motive.sql");
        $statements = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $motive)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }

}
