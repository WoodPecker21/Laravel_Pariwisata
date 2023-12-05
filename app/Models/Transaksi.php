<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idUser',
        'idBayar',
        'idObjek',
        'name',
        'jumlahTamu',
        'ktpNumber',
        'tglStart',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function bayar()
    {
        return $this->belongsTo(Pembayaran::class, 'idBayar', 'id');
    }

    public function objek()
    {
        return $this->belongsTo(ObjekWisata::class, 'idObjek', 'id');
    }
}
