<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit data']);
        Permission::create(['name' => 'delete data']);
        Permission::create(['name' => 'create data']);
        Permission::create(['name' => 'read data']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('edit data');
        $role1->givePermissionTo('delete data');
        $role1->givePermissionTo('create data');
        $role1->givePermissionTo('read data');

        $role2 = Role::create(['name' => 'guest']);
        $role2->givePermissionTo('create data');
        $role2->givePermissionTo('read data');


        // create users
        $user = User::where('name', 'admin')->first();
        $user->assignRole($role1);

        $user = User::where('name', 'guest')->first();;
        $user->assignRole($role2);

    }
}
