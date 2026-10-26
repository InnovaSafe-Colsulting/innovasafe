<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'reference',
        'tenant_id',
        'plan_id',
        'start_date',
        'end_date',
        'grace_period_end',
        'status',
        'auto_renew',
        'subtotal',
        'discount',
        'tax',
        'total',
    ];

    protected $casts = [
        'start_date'       => 'date',
        'end_date'         => 'date',
        'grace_period_end' => 'date',
        'auto_renew'       => 'boolean',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function services()
    {
        return $this->hasMany(SubscriptionService::class);
    }

    public function paymentAllocations()
    {
        return $this->hasMany(PaymentAllocation::class);
    }

    public function histories()
    {
        return $this->hasMany(SubscriptionHistory::class);
    }
}
