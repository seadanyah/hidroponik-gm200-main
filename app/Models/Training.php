<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
        'time',
        'location',
        'quota',
        'image',
    ];

    public function registrations()
    {
        return $this->hasMany(TrainingRegistration::class);
    }
}
