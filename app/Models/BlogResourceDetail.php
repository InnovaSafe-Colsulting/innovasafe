<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogResourceDetail extends Model
{
    protected $table = 'blog_resource_details';

    protected $fillable = [
        'title',
        'description',
        'url_link',
        'image',
        'resource_type_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function resourceType()
    {
        return $this->belongsTo(ResourcesType::class, 'resource_type_id');
    }
}
