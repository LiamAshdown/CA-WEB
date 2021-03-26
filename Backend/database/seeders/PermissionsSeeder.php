<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => Company::PERMISSIONS['view']]);
        Permission::create(['name' => Company::PERMISSIONS['update']]);
        $role = Role::create(['name' => User::ROLES['company_admin']]);

        $role->givePermissionTo(Company::PERMISSIONS['view']);
        $role->givePermissionTo(Company::PERMISSIONS['update']);

        $role = Role::create(['name' => User::ROLES['company_user']]);
    }
}
