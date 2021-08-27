<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];

    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge');
    }
}
