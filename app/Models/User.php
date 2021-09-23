<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'introduction',
        'profile_image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function challenges()
    {
        return $this->hasMany('App\Models\Challenge');
    }

    public function countChallenges($challenges): int
    {
        return count($challenges->whereIn('is_completed', [0, 1]));
    }

    public function countSuccess($challenges): int
    {
        return count($challenges->where('is_successful', 1));
    }

    public function currentChallenge($challenges)
    {
        return $challenges->where('is_completed', 0)->first();
    }
}
