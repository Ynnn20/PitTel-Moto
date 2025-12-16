<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat',
    ];

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }

    public function servis()
    {
        return $this->hasMany(Servis::class);
    }
}
