<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Initialize
    protected $fillable = [
        'kode_transaksi',
        'kode_barang',
        'nama_barang',
        'kategori',
        'warna',
        'ukuran',
        'harga',
        'jumlah',
        'total_barang',
        'subtotal',
        'diskon',
        'total',
        'bayar',
        'kembali',
    ];
}