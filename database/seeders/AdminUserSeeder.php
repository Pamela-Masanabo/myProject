<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'employee_id' => 'ADM001',
                'username' => 'admin',
                'password' => Hash::make('Admin123!'),
                'phone' => null,
                'role' => 'ADMIN',
                'department' => 'ADMINISTRATION',
                'specialty' => null,
                'email' => 'admin@dpcms.local',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
