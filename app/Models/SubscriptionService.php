<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionService extends Model
{
    protected $fillable = [
        'subscription_id',
        'service_id',
        'status',
        'activated_at',
        'deactivated_at',
        'deactivation_reason',
    ];

    protected $casts = [
        'activated_at'   => 'datetime',
        'deactivated_at' => 'datetime',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
