<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourcesType extends Model
{
    protected $table = 'resources_types';

    protected $fillable = [
        'resource',
        'description',
        'icon',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
