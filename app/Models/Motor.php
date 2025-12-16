<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = [
        'pelanggan_id',
        'merk',
        'model',
        'plat_nomor',
        'tahun',
        'warna',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function servis()
    {
        return $this->hasMany(Servis::class);
    }
}
