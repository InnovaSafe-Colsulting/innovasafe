<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogResourceDetail extends Model
{
    use HasFactory;

    protected $table = 'blog_resource_details';

    protected $fillable = [
        'resource_type_id',
        'title',
        'description',
        'url_link',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function resourceType()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }
}