<?php

namespace App\Http\Traits;
use App\Models\User;

trait DoctorTrait {
    /**
     * Return All Doctors , doctor's type_id is 1.
     */
    public function getDoctors() {
        return User::where('type_id', 1)->get();
    }
}