<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'video_url',
        'is_active',
    ];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_services');
    }

    public function subscriptionServices()
    {
        return $this->hasMany(SubscriptionService::class);
    }
}
