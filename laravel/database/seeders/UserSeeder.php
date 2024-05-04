<?php

namespace Database\Seeders;

use App\Models\Operator;
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
                'name' => 'Pasien',
                'email' => 'pasien@pasien.com',
                'gender'=>'Laki-laki',
                'password' => bcrypt('password'),
            ]
        ];
        
        foreach ($userData as $value) {
            User::create($value);
        }
        $dokterData = [
            [
                'name' => 'dokter',
                'email' => 'dokter@dokter.com',
                'password' => bcrypt('password'),
            ]
        ];
        
        foreach ($dokterData as $value) {
            dokter::create($value);
        }
        $operatorData = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]
        ];
        
        foreach ($operatorData as $value) {
            Operator::create($value);
        }
    }
}