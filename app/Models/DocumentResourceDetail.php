<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentResourceDetail extends Model
{
    use HasFactory;

    protected $table = 'documents_resources_details';

    protected $fillable = [
        'resource_type_id',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_size',
        'category',
        'difficulty_level',
        'steps',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'steps' => 'array'
    ];

    public function resourceType()
    {
        return $this->belongsTo(ResourceType::class, 'resource_type_id');
    }
}