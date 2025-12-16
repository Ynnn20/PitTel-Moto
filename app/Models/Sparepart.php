<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'stok',
        'minimal_stok',
        'harga',
        'satuan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
        'minimal_stok' => 'integer',
    ];
}
