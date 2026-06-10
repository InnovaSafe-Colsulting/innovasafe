<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigurationCompany extends Model
{
    protected $table = 'configuration_company';

    protected $fillable = ['name', 'value', 'status'];
}
