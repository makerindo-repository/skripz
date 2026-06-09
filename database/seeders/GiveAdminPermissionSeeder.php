<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GiveAdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all existing permissions
        $permissions = Permission::all();

        // Get the SuperAdmin role
        $adminRole = Role::where('name', 'SuperAdmin')->first();

        // If SuperAdmin role exists, assign all permissions to it
        if ($adminRole) {
            $adminRole->syncPermissions($permissions);
        }
    }
}
