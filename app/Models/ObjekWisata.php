<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;
    protected $table = 'objekwisatas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori',
        'gambar',
        'rating',
        'harga',
        'pulau',
        'durasi',
        'akomodasi',
        'transportasi',
    ];
}
