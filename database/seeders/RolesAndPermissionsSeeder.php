<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $arrayOfAllPermissionsNames = ['adminAdd', 'adminEdit', 'adminShow', 'adminsView', 'adminDelete', 'blogAdd', 'blogEdit', 'blogShow', 'blogsView', 'blogDelete', 'portfolioAdd', 'portfolioEdit', 'portfolioShow', 'portfoliosView', 'portfolioDelete', 'pricingAdd', 'pricingEdit', 'pricingShow', 'pricingsView', 'pricingDelete', 'requestAdd', 'requestsView', 'tagAdd', 'tagEdit', 'tagShow', 'tagsView', 'tagDelete'];
        $blogsPermissions = ['blogAdd', 'blogEdit', 'blogShow', 'blogsView', 'blogDelete'];
        $portfoliosPermissions = ['portfolioAdd', 'portfolioEdit', 'portfolioShow', 'portfoliosView', 'portfolioDelete'];
        $requestsPermissions = ['requestAdd', 'requestsView'];
        $pricesPermissions = ['pricingAdd', 'pricingEdit', 'pricingShow', 'pricingsView', 'pricingDelete'];

        $permissions = collect($arrayOfAllPermissionsNames)->map(function ($permission) {
            return ["name" => $permission, "guard_name" => "web"];
        });

        Permission::insert($permissions->toArray());

        Role::create(["name" => "super admin"])->givePermissionTo($arrayOfAllPermissionsNames);
        Role::create(["name" => "blogs writer"])->givePermissionTo($blogsPermissions);
        Role::create(["name" => "picies writer"])->givePermissionTo($pricesPermissions);
        Role::create(["name" => "portfolios writer"])->givePermissionTo($portfoliosPermissions);
        Role::create(["name" => "requests recipient"])->givePermissionTo($requestsPermissions);
    }
}
