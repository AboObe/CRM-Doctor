<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Interfaces\BasicRepositoryInterface;
use DataTables;
use Validator;



class AppointmentController extends Controller
{

    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new Appointment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments= $this->basicRepository->getAll($this->model);
        return $appointments;
        $result = [];
        foreach($appointments as $appointment)
        {
            $result=[
                'id' => $appointment->id,
            'representative_id' => $appointment->representative_id,
            'doctor_id' => $appointment->doctor_id,
            'location' => $appointment->location,
            'notes' => $appointment->notes,
            'actual_date' => date('Y-m-d H:i:s', $appointment->actual_date),
            'expected_date' => date('Y-m-d H:i:s',$appointment->expected_date),
            'status' => $appointment->status,
            'doctor_name' => $appointment->doctor->name,
            'doctor_address' => $appointment->doctor->address,
            ];
        }

        return view('appointment.calender',compact($result));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(appointment $appointment)
    {
        //
    }
}
