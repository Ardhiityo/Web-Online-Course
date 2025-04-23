<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'pricing_id',
        'booking_trx_id',
        'sub_total_amount',
        'grand_total_amount',
        'total_tax_amount',
        'is_paid',
        'payment_type',
        'proof',
        'started_at',
        'ended_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
}
