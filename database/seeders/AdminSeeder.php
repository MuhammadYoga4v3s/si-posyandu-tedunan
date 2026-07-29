<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@tedunan.test',
            'password' => Hash::make('admin123'),
            'role' => 'administrator',
            'status' => true,
            'last_login' => null,
        ]);
    }
}