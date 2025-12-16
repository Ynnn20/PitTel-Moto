<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $fillable = [
        'nama',
        'spesialisasi',
        'telepon',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function servis()
    {
        return $this->hasMany(Servis::class);
    }
}
