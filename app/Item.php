<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'warna',
        'ukuran',
        'stok',
        'harga',
        'keterangan',
    ];
}