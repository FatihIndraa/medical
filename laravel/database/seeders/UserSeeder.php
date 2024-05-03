<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Models\dokter;
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
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Pasien',
                'email' => 'pasien@pasien.com',
                'gender' => 'Laki-laki',
                'alamat' => 'Jalan Pasien No. 1',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Dokter',
                'email' => 'dokter@dokter.com',
                'password' => bcrypt('password')
            ],
        ];
        
        foreach ($userData as $value) {
            User::create($value);
        }
    }
}