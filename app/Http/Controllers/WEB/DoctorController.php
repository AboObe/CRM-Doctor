<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Http\Request;
use DataTables;
use Validator;


class DoctorController extends Controller
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new Doctor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $doctors= $this->basicRepository->getAll($this->model);
         if($request->ajax()){

            return Datatables::of($doctors)

                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $btn = '<a href="'.route('doctor.edit',['doctor'=>$row->id]).'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm edit"> <i class="fa fa-edit"></i>  </a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"> <i class="fa fa-trash"></i>    </a>';

                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);
                return;
        }

        return view('doctor/index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateErrors = Validator::make($request->all(),[
            'name'   => 'required|max:250',
            'center'   => 'required|max:250',
            'phone'   => 'required',
            'website'   => 'required',
            'address'   => 'required',
            'status_contract'   => 'required|in:pending,signature',
            'status_doctor'   => 'required|in:inactive,active',
            'email'   => 'email',
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

        $doctor = $this->basicRepository->create($this->model,$doctorDetails);
        return response()->json([
            "status"=>200,"message"=>"success"]);
        return redirect()->intended('doctor');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = $this->basicRepository->getById($this->model,$id);
        return view('doctor/show',compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = $this->basicRepository->getById($this->model,$id);
        return view('doctor/create',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
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

        return redirect()->intended('doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctorDetails = [
            'status_doctor'=> 'inactive'
        ];

        $doctor = $this->basicRepository->update($this->model, $id, $doctorDetails);

        return redirect()->intended('doctor');
    }
}
