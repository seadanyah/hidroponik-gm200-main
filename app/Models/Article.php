<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
