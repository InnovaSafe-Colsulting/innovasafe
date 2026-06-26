<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeServiceDetail extends Model
{
    protected $table = 'type_services_detail';
    
    protected $fillable = [
        'module',
        'type_module',
        'type_service_id',
        'status'
    ];
    
    protected $casts = [
        'status' => 'string'
    ];
    
    public function typeService(): BelongsTo
    {
        return $this->belongsTo(TypeService::class);
    }
    
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = $value == true ? '1' : '0';
    }
    
    public function getStatusAttribute($value)
    {
        return $value === '1';
    }
}