<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingRegistration extends Model
{
    protected $table = 'training_registrations';

    protected $fillable = [
        'training_id',
        'name',
        'email',
        'phone',
        'pekerjaan',
        'institusi'
    ];

    public $timestamps = true;
}
