<?php

namespace Database\Seeders;

use App\Domains\Entities\Models\Admin;
use App\Domains\Entities\Models\Coach;
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
        Permission::create(['name' => 'add admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'add user', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit user', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update user', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete user', 'guard_name' => 'admin']);

        Permission::create(['name' => 'add task', 'guard_name' => 'coach']);
        Permission::create(['name' => 'update task', 'guard_name' => 'coach']);
        Permission::create(['name' => 'delete task', 'guard_name' => 'coach']);

        Permission::create(['name' => 'add subscribe', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update subscribe', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete subscribe', 'guard_name' => 'admin']);

        Permission::create(['name' => 'add diet', 'guard_name' => 'admin']);
        Permission::create(['name' => 'update diet', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete diet', 'guard_name' => 'admin']);

        // create ROLES and assign existing permissions
        $role1 = Role::create(['name' => 'super admin', 'guard_name' => 'admin']);
        $role1->givePermissionTo('add admin');
        $role1->givePermissionTo('edit admin');
        $role1->givePermissionTo('update admin');
        $role1->givePermissionTo('delete admin');

        $role2 = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $role2->givePermissionTo('add user');
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('update user');
        $role2->givePermissionTo('delete user');

        $role3 = Role::create(['name' => 'coach', 'guard_name' => 'coach']);
        $role3->givePermissionTo('add task');
        $role3->givePermissionTo('update task');

        $role4 = Role::create(['name' => 'accountant', 'guard_name' => 'admin']);
        $role4->givePermissionTo('add subscribe');
        $role4->givePermissionTo('add user');

        $role5 = Role::create(['name' => 'specialist', 'guard_name' => 'admin']);
        $role5->givePermissionTo('add diet');
        $role5->givePermissionTo('update diet');
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $superAdmin = Admin::factory()->create([
            'name' => 'super admin',
            'email' => 'superadmin@example.com',
        ]);
        $superAdmin->assignRole($role1);

        $admin = Admin::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        $admin->assignRole($role2);

        $coach = Coach::factory()->create([
            'name' => 'ibrahim',
            'email' => 'coach@gmail.com',
        ]);
        $coach->assignRole($role3);

        $accountant = Admin::factory()->create([
            'name' => 'accountant',
            'email' => 'accountant@gmail.com',
        ]);
        $accountant->assignRole($role4);

        $specialist = Admin::factory()->create([
            'name' => 'specialist',
            'email' => 'specialist@gmail.com',
        ]);
        $specialist->assignRole($role5);
    }
}
