<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'admin']);

        $superAdmin = User::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@birotelematika.go.id',
                'password' => bcrypt('ubah_password_ini'),
            ]
        );

        if (! $superAdmin->hasRole('super_admin')) {
            $superAdmin->assignRole($superAdminRole);
        }
    }
}