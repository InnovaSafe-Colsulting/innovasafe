<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reference',
        'tenant_id',
        'payment_date',
        'total_amount',
        'currency',
        'status',
        'payment_method',
        'transaction_reference',
        'description',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function allocations()
    {
        return $this->hasMany(PaymentAllocation::class);
    }
}
