<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'is_completed',
        'is_successful',
    ];

    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge');
    }
}
