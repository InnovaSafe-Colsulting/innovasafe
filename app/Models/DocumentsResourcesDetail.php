<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsResourcesDetail extends Model
{
    protected $table = 'documents_resources_details';

    protected $fillable = [
        'title',
        'path',
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
