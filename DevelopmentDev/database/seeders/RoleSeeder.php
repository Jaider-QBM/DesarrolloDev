<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superAdmin = Role::create(['name' => 'Super Administrador']);
        $role_admin = Role::create(['name' => 'Administrador']);
        $role_usuRegu = Role::create(['name' => 'Usuario Regular']);
        $role_usuRegu = Role::create(['name' => 'Cliente']);

        $permission_create_role = Permission::create(['name' => 'create roles']);
        $permission_read_role = Permission::create(['name' => 'read roles']);
        $permission_update_role = Permission::create(['name' => 'update roles']);
        $permission_delete_role = Permission::create(['name' => 'delete roles']);

        $permission_create_user = Permission::create(['name' => 'create user']);
        $permission_read_user = Permission::create(['name' => 'read user']);
        $permission_update_user = Permission::create(['name' => 'update user']);
        $permission_delete_user = Permission::create(['name' => 'delete user']);
        $permission_import_user = Permission::create(['name' => 'import user']);


        $permission_create_company = Permission::create(['name' => 'create company']);
        $permission_read_company = Permission::create(['name' => 'read company']);
        $permission_update_company = Permission::create(['name' => 'update company']);
        $permission_delete_company = Permission::create(['name' => 'delete company']);

        $permissions_superAdmin = [
            $permission_create_role,
            $permission_read_role,
            $permission_update_role,
            $permission_delete_role,
            $permission_create_user,
            $permission_read_user,
            $permission_update_user,
            $permission_delete_user,
            $permission_import_user,
            $permission_read_company,
            $permission_create_company,
            $permission_update_company,
            $permission_delete_company
        ];

        $permissions_admin = [
            $permission_read_role,
            $permission_update_role,
            $permission_create_user,
            $permission_read_user,
            $permission_update_user,
            $permission_create_role
        ];

        $permissions_usuRegu = [$permission_read_role];

        $role_superAdmin->syncPermissions($permissions_superAdmin);
        $role_admin->syncPermissions($permissions_admin);
        $role_usuRegu->syncPermissions($permissions_usuRegu);
    }
}
