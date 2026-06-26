<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    use HasFactory;

    protected $table = 'resources_types';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function documentResources()
    {
        return $this->hasMany(DocumentResourceDetail::class, 'resource_type_id');
    }

    public function blogResources()
    {
        return $this->hasMany(BlogResourceDetail::class, 'resource_type_id');
    }
}