<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeService extends Model
{
    protected $fillable = [
        'name',
        'description', 
        'video_url',
        'status'
    ];
    
    protected $casts = [
        'status' => 'string'
    ];
    
    public function details(): HasMany
    {
        return $this->hasMany(TypeServiceDetail::class);
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
