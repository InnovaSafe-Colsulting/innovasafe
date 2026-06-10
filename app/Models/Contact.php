<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = ['names', 'last_names', 'cellphone', 'email', 'service_id', 'message'];
           
    public function service(): BelongsTo
    {
        return $this->belongsTo(TypeService::class, 'service_id');
    }
}
