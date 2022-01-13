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
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'work_type',
        'mobile_number',
        'profile_photo',
        'admin',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the zones this representative works at them.
     */
    public function zones()
    {
        return $this->hasMany(Zone::class);
    }

    /**
     * Get the doctors this representative works with them.
     */
    public function doctors()
    {
        return $this->hasMany(Zone::class);
    }

    /**
     * Get the appointments for the representative.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
