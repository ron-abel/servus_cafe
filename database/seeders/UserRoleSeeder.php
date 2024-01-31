<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            ['role_name' => 'Super Admin'],
            ['role_name' => 'Tenant Admin'],
            ['role_name' => 'Student'],
        ]);
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'test1@gmil.com',
            'password' => Hash::make('admin123'),
            'user_role_id' => 1,
            'tenant_id' => '0',
        ]);
    }
}
