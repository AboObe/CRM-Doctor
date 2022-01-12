<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'representative_id', 'doctor_id', 'location', 'notes', 'actual_date', 'expected_date', 'status'
    ];

    /**
     * Get the doctor is associated with the appointment.
     */
    public function doctor()
    {
        return $this->belongsTo(doctor::class, 'doctor_id');
    }

    /**
     * Get the representative is associated with the appointment.
     */
    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }
}
