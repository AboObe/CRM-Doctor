<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends BaseController
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware('auth:sanctum');
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
        return "no action";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "no action";
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $representative_id = Auth::user()->id;

        $input = $request->all();
        $validator = Validator::make($input, [
            'doctor_id'   => 'required',
            'expected_date'   => 'required|date',
            'actual_date' => 'date'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $appointmentDetails = $request->only([
                'doctor_id',
                'expected_date',
                'location',
                'notes',
                'actual_date',
                'status',
            ]);

        $appointmentDetails['representative_id'] = $representative_id;

        $appointment = $this->basicRepository->create($this->model,$appointmentDetails);

        return $this->sendResponse($appointment , 'Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
		return "no action";
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       return "no action";
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $representative_id = Auth::user()->id;

        $input = $request->all();
        
        $validator = Validator::make($input, [
            'doctor_id'   => 'required',
            'expected_date'   => 'date',
            'actual_date' => 'date'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $appointmentDetails = $request->only([
                'doctor_id',
                'expected_date',
                'location',
                'notes',
                'actual_date',
                'status',
            ]);

        $appointmentDetails['representative_id'] = $representative_id;
      
        $appointment = $this->basicRepository->update($this->model, $id, $appointmentDetails);

        return $this->sendResponse($appointment , 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {

    }

   
}
