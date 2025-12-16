<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    protected $table = 'servis';

    protected $fillable = [
        'pelanggan_id',
        'motor_id',
        'mekanik_id',
        'keluhan',
        'tindakan',
        'biaya',
        'status',
        'tanggal_servis',
        'selesai_at',
        'paid',
    ];

    protected $casts = [
        'tanggal_servis' => 'date',
        'selesai_at' => 'datetime',
        'biaya' => 'decimal:2',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
