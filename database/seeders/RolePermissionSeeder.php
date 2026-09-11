<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Dashboard & Analytics
            'view-dashboard',
            'view-analytics',
            'clear-analytics',

            // Hero
            'view-hero',
            'update-hero',

            // Tentang Kami
            'view-tentang-kami',
            'update-tentang-kami',

            // Paket Internet
            'view-paket',
            'create-paket',
            'edit-paket',
            'delete-paket',

            // Tutorial
            'view-tutorial',
            'create-tutorial',
            'edit-tutorial',
            'delete-tutorial',

            // Tags
            'view-tags',
            'create-tags',
            'edit-tags',
            'delete-tags',

            // Keunggulan
            'view-keunggulan',
            'create-keunggulan',
            'edit-keunggulan',
            'delete-keunggulan',

            // SEO
            'view-seo',
            'update-seo',

            // Settings
            'view-settings',
            'update-settings',

            // User Management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',

            // Role Management
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'view-dashboard',
            'view-analytics',
            'view-hero', 'update-hero',
            'view-tentang-kami', 'update-tentang-kami',
            'view-paket', 'create-paket', 'edit-paket', 'delete-paket',
            'view-tutorial', 'create-tutorial', 'edit-tutorial', 'delete-tutorial',
            'view-tags', 'create-tags', 'edit-tags', 'delete-tags',
            'view-keunggulan', 'create-keunggulan', 'edit-keunggulan', 'delete-keunggulan',
            'view-seo', 'update-seo',
            'view-settings', 'update-settings',
        ]);

        $operator = Role::firstOrCreate(['name' => 'Operator', 'guard_name' => 'web']);
        $operator->syncPermissions([
            'view-dashboard',
            'view-paket', 'create-paket', 'edit-paket',
            'view-tutorial', 'create-tutorial', 'edit-tutorial',
            'view-tags', 'create-tags', 'edit-tags',
            'view-keunggulan', 'create-keunggulan', 'edit-keunggulan',
        ]);

        $user = User::firstOrCreate(
            ['email' => 'admin@cionetwork.id'],
            [
                'name' => 'Admin CIO',
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            ]
        );
        $user->assignRole('Super Admin');
    }
}
