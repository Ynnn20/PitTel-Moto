<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'servis_id',
        'amount',
        'method',
        'status',
        'payment_date',
    ];

    public function servis()
    {
        return $this->belongsTo(Servis::class);
    }
}
