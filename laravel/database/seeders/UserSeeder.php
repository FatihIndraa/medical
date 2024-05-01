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
                'password' => bcrypt('password')
            ],
        ];
        $dokterData = [
            [
                'name'=> 'dokter',
                'email'=> 'dokter@dokter.com',
                'password'=>bcrypt('password'),
            ],
        ];
        
        foreach ($dokterData as $value) {
            Dokter::create($value);
        }
        
        foreach ($userData as $key => $value) {
            User::create($value);
        }
        
    }
}
