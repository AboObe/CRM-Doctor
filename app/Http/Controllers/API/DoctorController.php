<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Interfaces\BasicRepositoryInterface; 
use App\Models\Doctor;
use Illuminate\Validation\Rule;


class DoctorController extends BaseController
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware('auth:sanctum');
        $this->basicRepository = $basicRepository;
        $this->model = new Doctor;
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'   => 'required|max:250',
            'center'   => 'required|max:250',
            'phone'   => 'required',
            'address'   => 'required',
            'status_contract'   => 'required|in:pending,signature',
            'status_doctor'   => 'required|in:inactive,active',
            'email'   => 'email',
            'website' =>  [
                'required', 
                Rule::unique('doctors')
                       ->where('phone', $this->phone)
               ]
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $doctorDetails = $request->only([
                'name',
                'center',
                'mobile_number',
                'phone',
                'website',
                'address',
                'status_contract',
                'status_doctor',
                'email',
                'city',
                'region',
                'country',
            ]);

        $doctor = $this->basicRepository->create($this->model,$doctorDetails);

        return $this->sendResponse($doctor , 'Doctor created successfully.');        
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
    public function edit($id)
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
        $validateErrors = Validator::make($request->all(),[
            'name'   => 'required|max:250',
            'center'   => 'required|max:250',
            'phone'   => 'required',
            'address'   => 'required',
            'status_contract'   => 'required|in:pending,signature',
            'status_doctor'   => 'required|in:inactive,active',
            'email'   => 'email',
            'website' =>  [
                'required', 
                Rule::unique('doctors')
                       ->ignore($this->doctor)
                       ->where('phone', $this->phone)
               ]
        ]);
        if ($validateErrors->fails()) {
            return response()->json(['status' => 201, 'message' => $validateErrors->errors()->first()]);
        } // end if fails .
        $doctorDetails = $request->only([
            'name',
            'center',
            'mobile_number',
            'phone',
            'website',
            'address',
            'status_contract',
            'status_doctor',
            'email',
            'city',
            'region',
            'country',
            'postal_code'
        ]);

        $doctor = $this->basicRepository->update($this->model, $id, $doctorDetails);

        return $this->sendResponse($doctor , 'Doctor updated successfully.'); 
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
