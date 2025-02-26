<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penerbit extends Model
{
    protected $fillable = [
        'id_penerbit',
        'nama',
        'alamat',
        'kota',
        'telepon'
    ];

    public function bukus()
    {
        return $this->hasMany(Buku::class, 'id_penerbit', 'id');
    }
}
