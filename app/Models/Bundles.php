<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundles extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'duration',
        'value',
        'category_id',
        'description',
    ];
}
