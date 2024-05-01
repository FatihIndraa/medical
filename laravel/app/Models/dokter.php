<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;


class Dokter extends Model
{
    protected $fillable = [
        'name', 'email', 'password', // dan atribut lain yang ingin Anda izinkan untuk diisi massal
    ];

    public function rekamMedis(){
        return $this->hasMany(RekamMedis::class);
    }
}
