<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('slug', '=', 'atmadmin')->first() === null) {
            $collectorRole = Role::create([
                'name'        => 'ATM Admin',
                'slug'        => 'atmadmin',
                'description' => 'ATM Admin Role',
                'level'       => 4,
            ]);
        }

        if (Role::where('slug', '=', 'atmoperator')->first() === null) {
            $collectorRole = Role::create([
                'name'        => 'ATM Operator',
                'slug'        => 'atmoperator',
                'description' => 'ATM Operator Role',
                'level'       => 3,
            ]);
        }

        if (Role::where('slug', '=', 'atmcollector')->first() === null) {
            $collectorRole = Role::create([
                'name'        => 'ATM Collector',
                'slug'        => 'atmcollector',
                'description' => 'ATM Collector Role',
                'level'       => 2,
            ]);
        }

        if (Role::where('slug', '=', 'user')->first() === null) {
            $userRole = Role::create([
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ]);
        }

        if (Role::where('slug', '=', 'unverified')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ]);
        }
    }
}
