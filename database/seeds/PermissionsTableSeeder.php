<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
         * Permissions for User model
         *
         */
        if (Permission::where('name', '=', 'Can View Users')->first() === null) {
            Permission::create([
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Users',
                'slug'        => 'create.users',
                'description' => 'Can create new users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Users',
                'slug'        => 'edit.users',
                'description' => 'Can edit users',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Users')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ]);
        }

        /*
         * Permissions for Vertical Signals
         *
         */
        if (Permission::where('name', '=', 'Can View Vertical Signals')->first() === null) {
            Permission::create([
                'name'        => 'Can View Vertical Signals',
                'slug'        => 'view.verticalsignal',
                'description' => 'Can view vertical signals',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Vertical Signals')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Vertical Signals',
                'slug'        => 'create.verticalsignal',
                'description' => 'Can create new vertical signals',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Vertical Signals')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Vertical Signals',
                'slug'        => 'edit.verticalsignal',
                'description' => 'Can edit vertical signals',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Vertical Signals')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Vertical Signals',
                'slug'        => 'delete.verticalsignal',
                'description' => 'Can delete vertical signals',
                'model'       => 'Permission',
            ]);
        }

        /*
         * Permissions for SignalsInventory
         *
         */
        if (Permission::where('name', '=', 'Can View Signals Inventory')->first() === null) {
            Permission::create([
                'name'        => 'Can View Signals Inventory',
                'slug'        => 'view.signalinventory',
                'description' => 'Can view signal inventory',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Create Signals Inventory')->first() === null) {
            Permission::create([
                'name'        => 'Can Create Signals Inventory',
                'slug'        => 'create.signalinventory',
                'description' => 'Can create new signals inventory',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Edit Signals Inventory')->first() === null) {
            Permission::create([
                'name'        => 'Can Edit Signals Inventory',
                'slug'        => 'edit.signalinventory',
                'description' => 'Can edit signals inventory',
                'model'       => 'Permission',
            ]);
        }

        if (Permission::where('name', '=', 'Can Delete Signals Inventory')->first() === null) {
            Permission::create([
                'name'        => 'Can Delete Signals Inventory',
                'slug'        => 'delete.signalinventory',
                'description' => 'Can delete signals inventory',
                'model'       => 'Permission',
            ]);
        }
    }
}
