<?php

namespace App\Http\Controllers\API; 

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Resources\AppointmentResource;

class ReportController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
 
   /**
     * get future appointment 
     */
    public function appointmentsFuture()
    {
        $representative_id = Auth::user()->id;
        $current_time = Carbon::now()->format('Y-m-d h:m:s');
        $appointments = Appointment::where('representative_id',$representative_id)
                                    ->where('expected_date','>',$current_time)->get();


        $appointmentsCollection =  collect();
        foreach($appointments as $appointment)
        {
                $appointmentsCollection->push(new AppointmentResource($appointment));
        }

        return $this->sendResponse($appointmentsCollection , 'Appointments Future returned successfully.');
    }
     /**
      * get old appointment
      */
    public function appointmentsPast()
    {
        $representative_id = Auth::user()->id;
        $current_time = Carbon::now()->format('Y-m-d h:m:s');
        $appointments = Appointment::where('representative_id',$representative_id)
                                    ->where('expected_date','<',$current_time)->get();
        $appointmentsCollection =  collect();
        foreach($appointments as $appointment)
        {
                $appointmentsCollection->push(new AppointmentResource($appointment));
        }

        return $this->sendResponse($appointmentsCollection , 'Appointments Past returned successfully.');

    }
}