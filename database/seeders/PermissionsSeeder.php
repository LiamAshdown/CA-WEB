<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyCustomization;
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

        Permission::create(['name' => User::PERMISSIONS['view']]);
        Permission::create(['name' => User::PERMISSIONS['store']]);
        Permission::create(['name' => User::PERMISSIONS['update']]);
        Permission::create(['name' => Company::PERMISSIONS['view']]);
        Permission::create(['name' => Company::PERMISSIONS['update']]);
        Permission::create(['name' => CompanyCustomization::PERMISSIONS['view']]);
        Permission::create(['name' => CompanyCustomization::PERMISSIONS['update']]);

        $role = Role::create(['name' => User::ROLES['company_admin']]);
        $role->givePermissionTo(User::PERMISSIONS['view']);
        $role->givePermissionTo(User::PERMISSIONS['update']);
        $role->givePermissionTo(User::PERMISSIONS['store']);
        $role->givePermissionTo(Company::PERMISSIONS['view']);
        $role->givePermissionTo(Company::PERMISSIONS['update']);
        $role->givePermissionTo(CompanyCustomization::PERMISSIONS['view']);
        $role->givePermissionTo(CompanyCustomization::PERMISSIONS['update']);

        $role = Role::create(['name' => User::ROLES['company_sub_admin']]);
        $role->givePermissionTo(Company::PERMISSIONS['view']);
        $role->givePermissionTo(Company::PERMISSIONS['update']);
        $role->givePermissionTo(CompanyCustomization::PERMISSIONS['view']);
        $role->givePermissionTo(CompanyCustomization::PERMISSIONS['update']);

        $role = Role::create(['name' => User::ROLES['company_user']]);
        $role->givePermissionTo(CompanyCustomization::PERMISSIONS['view']);
    }
}
