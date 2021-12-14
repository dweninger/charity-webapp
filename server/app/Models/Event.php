<?php
/**
 * Model for events
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation;

class Event extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'volunteer_slots',
        'donated_amount',
        'created_date',
        'date_time',
        'hours',
        'donation_goal',
        'active',
    ];
    
    /* Many to many relationships */
    public function programs(){
        return $this->belongsToMany(Program::class, 'program_event');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_event');
    }
}
