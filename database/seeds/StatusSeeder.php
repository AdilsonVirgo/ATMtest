<?php

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $status = file_get_contents(database_path() . "/scripts/status.sql");
        $statements = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $status)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }

}
