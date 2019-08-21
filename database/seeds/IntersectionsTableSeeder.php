<?php

use Illuminate\Database\Seeder;

class IntersectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interceptions = file_get_contents(database_path() ."/scripts/intersections.sql");
        $statements = array_filter(array_map('trim', explode(';', $interceptions)));

        foreach ($statements as $stmt) {
            DB::statement($stmt);
        }
    }
}
