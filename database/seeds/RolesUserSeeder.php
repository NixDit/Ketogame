<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Superadmin
        $role = Role::create(['name' => 'superadmin']);
        // Permission::create(['name' => 'destroy_notes']);
        // $role->givePermissionTo('destroy_notes');

        // Moderator
        $role = Role::create(['name' => 'moderator']);
        // Permission::create(['name' => 'destroy_notes']);
        // $role->givePermissionTo('destroy_notes');

        // Guest
        $role = Role::create(['name' => 'guest']);
        // Permission::create(['name' => 'destroy_notes']);
        // $role->givePermissionTo('destroy_notes');
    }
}
