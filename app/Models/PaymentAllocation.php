<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAllocation extends Model
{
    protected $fillable = [
        'payment_id',
        'subscription_id',
        'amount',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
