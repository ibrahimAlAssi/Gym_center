<?php

namespace Database\Seeders;

use App\Domains\Entities\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create PERMISSIONS
        Permission::create(['name' => 'add users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'add task', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update task', 'guard_name' => 'admin']);
        Permission::create(['name' => 'add subscribe', 'guard_name' => 'admin']);
        Permission::create(['name' => 'add diet', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update diet', 'guard_name' => 'admin']);

        // create ROLES and assign existing permissions
        $role1 = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo('add users');
        $role1->givePermissionTo('edit users');
        $role1->givePermissionTo('update users');
        $role1->givePermissionTo('delete users');
        // $role1->givePermissionTo('update subscribe');

        $role2 = Role::create(['name' => 'coach', 'guard_name' => 'admin']);
        $role2->givePermissionTo('add task');
        $role2->givePermissionTo('update task');

        $role3 = Role::create(['name' => 'accountant', 'guard_name' => 'admin']);
        $role2->givePermissionTo('add subscribe');
        $role2->givePermissionTo('add users');

        $role4 = Role::create(['name' => 'specialist', 'guard_name' => 'admin']);
        $role2->givePermissionTo('add diet');
        $role2->givePermissionTo('update diet');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $admin = Admin::factory()->create([
            'name' => 'Example admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole($role1);

        $admin = Admin::factory()->create([
            'name' => 'Example coach',
            'email' => 'coach@example.com',
        ]);
        $admin->assignRole($role2);

        $admin = Admin::factory()->create([
            'name' => 'Example accountant',
            'email' => 'accountant@example.com',
        ]);
        $admin->assignRole($role3);

        $admin = Admin::factory()->create([
            'name' => 'Example specialist',
            'email' => 'specialist@example.com',
        ]);
        $admin->assignRole($role4);
    }
}
