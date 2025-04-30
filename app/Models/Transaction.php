<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaction extends Model
{
    use SoftDeletes, HasUuids;

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

    protected function casts(): array
    {
        return [
            'is_paid' => 'boolean'
        ];
    }

    public function newUniqueId()
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds()
    {
        return ['booking_trx_id'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pricing()
    {
        return $this->belongsTo(Pricing::class);
    }
}
