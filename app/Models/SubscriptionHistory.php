<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    protected $fillable = [
        'subscription_id',
        'old_status',
        'new_status',
        'reason',
        'changed_by',
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
