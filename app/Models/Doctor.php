<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'center', 'mobile_number', 'phone', 'website', 'address',
         'status_contract', 'status_doctor',
        'email', 'city', 'region', 'country', 'postal_code', 'assign_to'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m',
    ];

     /**
     * Get the Representative this meeting the doctor.
     */
    public function representative()
    {
        return $this->belongsTo(User::class,'assign_to');
    }


    /**
     * Get the appointments for the doctor.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}