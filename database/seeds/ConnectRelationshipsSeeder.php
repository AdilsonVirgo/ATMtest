<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Get Available Permissions.
         */
        $permissions = Permission::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = Role::where('slug', '=', 'admin')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

        $roleCollector = Role::where('slug', '=', 'atmadmin')->first();
        $roleCollector->attachPermission(Permission::where('slug', '=', 'view.signalinventory')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'create.signalinventory')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'edit.signalinventory')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'delete.signalinventory')->first());

        $roleCollector = Role::where('slug', '=', 'atmcollector')->first();
        $roleCollector->attachPermission(Permission::where('slug', '=', 'view.verticalsignal')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'create.verticalsignal')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'edit.verticalsignal')->first());
        $roleCollector->attachPermission(Permission::where('slug', '=', 'delete.verticalsignal')->first());
    }
}
