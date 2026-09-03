<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'productions';

    protected $fillable = [
        'plant_name',
        'planting_date',
        'harvest_date',
        'quantity',
        'notes'
    ];
}
