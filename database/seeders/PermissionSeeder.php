<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $userRole = Role::create([
            'name' => 'user'
        ]);

        $customersPagePermission = Permission::create(['name' => 'can view customers']);
        $productsPagePermission = Permission::create(['name' => 'can view products']);
        $ordersPagePermission = Permission::create(['name' => 'can view orders']);
        $reportsPagePermission = Permission::create(['name' => 'can view reports']);
        $viewProfitPermission = Permission::create(['name' => 'can view profit']);
        $viewHomeCardsPermission = Permission::create(['name' => 'can view home cards']);

        $adminRole->syncPermissions([
            $customersPagePermission,
            $productsPagePermission,
            $ordersPagePermission,
            $reportsPagePermission,
            $viewProfitPermission,
            $viewHomeCardsPermission,
        ]);

        $userRole->syncPermissions([
            $customersPagePermission,
            $productsPagePermission,
            $ordersPagePermission,
//            $reportsPagePermission,
//            $viewProfitPermission,
//            $viewHomeCardsPermission,
        ]);

        foreach (User::all() as $user) {
            $user->assignRole(['user']);
        }



    }
}
