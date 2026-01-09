<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS (SYSTEM WIDE)
        |--------------------------------------------------------------------------
        */
        $permissions = [

            // Dashboard
            'view dashboard',

            // Users
            'manage users',
            'create users',
            'edit users',
            'delete users',

            // Apartments
            'manage apartments',
            'view apartments',

            // Floors
            'manage floors',

            // Rooms
            'manage rooms',

            // Bookings
            'create booking',
            'view own bookings',
            'manage bookings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */
        $roles = [
            'admin',
            'manager',
            'user',
            'customer',
            'buyer',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLE → PERMISSION MAPPING
        |--------------------------------------------------------------------------
        */

        // ADMIN → ALL PERMISSIONS
        $admin = Role::where('name', 'admin')->first();
        $admin->syncPermissions(Permission::all());

        // MANAGER → OPERATIONS + BOOKINGS
        Role::where('name', 'manager')->first()->syncPermissions([
            'view dashboard',
            'manage apartments',
            'manage floors',
            'manage rooms',
            'manage bookings',
        ]);

        // USER → BASIC ACCESS
        Role::where('name', 'user')->first()->syncPermissions([
            'view apartments',
            'create booking',
            'view own bookings',
        ]);

        // CUSTOMER → VIEW + BOOK
        Role::where('name', 'customer')->first()->syncPermissions([
            'view apartments',
            'create booking',
            'view own bookings',
        ]);

        // BUYER → VIEW ONLY
        Role::where('name', 'buyer')->first()->syncPermissions([
            'view apartments',
        ]);
    }
}
