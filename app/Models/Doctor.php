<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'center', 'mobile_number', 'phone', 'website', 'address', 'status_contract', 'status_doctor',
        'email', 'city', 'region', 'country', 'postal_code'
    ];
}