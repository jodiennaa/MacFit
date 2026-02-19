<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipments extends Model
{
    protected $fillable = [
        'name',
        'usage',
        'model_number',
        'value',
        'status',
    ];
}
