<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'billing_period',
        'is_active',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'plan_services');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
