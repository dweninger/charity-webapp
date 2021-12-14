<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first',
        'last',
        'dob',
        'date_joined',
        'email',
        'password',
        'type',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttribute($password){
    //     $this->attributes['password'] = bcrypt($password);
    // }

    public function getFirstAttribute($first){
        return ucfirst($first);
    }

    public function getLastAttribute($last){
        return ucfirst($last);
    }

    public function events() {
        return $this->belongsToMany(Event::class, 'user_event');
    }
    public function programs() {
        return $this->belongsToMany(Program::class, 'donor_program');
    }

    public function unrestricted_donations() {
        return $this->belongsToMany(Program::class, 'unrestricted_donations');
    }
}
