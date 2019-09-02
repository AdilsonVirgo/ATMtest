<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ConfigurationsTableSeeder::class);
        $this->call(IntersectionsTableSeeder::class);
        $this->call(SignalGroupsTableSeeder::class);
        $this->call(SignalSubgroupTableSeeder::class);
        $this->call(SignalsDimensionTableSeeder::class);
        $this->call(SignalsInventoryTableSeeder::class);
        $this->call(SignalsVariationsTableSeeder::class);
        $this->call(VerticalSignalsTableSeeder::class);
        $this->call(DevicesInventoryTableSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PrioritySeeder::class);
        $this->call(MotiveSeeder::class);
        //$this->call(MaterialSeeder::class);
        Model::reguard();
    }

}
