<?php
/**
 * Model for Programs
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation;

class Program extends Model
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
        'total_volunteers',
        'total_donations',
        'created_date',
    ];
    /* Many to many relationship with events */
    public function event(){
        return $this->belongsToMany(Event::class, 'program_event');
    }
    /* One to many relationship with users (donor_programs) */
    public function users(){
        return $this->belongsToMany(User::class, 'donor_program');
    }
}
