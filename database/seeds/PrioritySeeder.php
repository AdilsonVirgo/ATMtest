<?php

use Illuminate\Database\Seeder;
use App\Models\Priority;

class PrioritySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $priority = file_get_contents(database_path() . "/scripts/priority.sql");
        $statements = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $priority)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }

}
