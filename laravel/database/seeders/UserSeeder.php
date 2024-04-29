<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $userData = [
        [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ],
        [
            'name' => 'pasien',
            'email' => 'pasien@pasien.com',
            'role' => 'pasien',
            'password' => bcrypt('password'),
        ],
        [
            'name' => 'dokter',
            'email' => 'dokter@dokter.com',
            'role' => 'dokter',
            'password' => bcrypt('password'),
        ]
       ];

       foreach ($userData as $user) {
           User::create($user);
       }
    }
}
