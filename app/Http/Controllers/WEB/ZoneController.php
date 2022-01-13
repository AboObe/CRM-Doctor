<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Interfaces\BasicRepositoryInterface;
use DataTables;
use Validator;
use App\Http\Traits\ImageUploadTrait;

class ZoneController extends Controller
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware(['auth',"isAdmin"]);
        $this->basicRepository = $basicRepository;
        $this->model = new User;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users= $this->basicRepository->getAll($this->model);
        if($request->ajax()){

            return Datatables::of($users)

                ->addIndexColumn()

                ->addColumn('action', function($row){

                    $btn = '<a href="'.route('user.edit',['user'=>$row->id]).'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary btn-sm edit"> <i class="fa fa-edit"></i>  </a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm delete"> <i class="fa fa-trash"></i>    </a>';

                    return $btn;

                })

                ->rawColumns(['action'])

                ->make(true);
                return;
        }

        return view('user/index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $validateErrors = Validator::make($request->all(), [
            'name'   => 'required|max:250',
            'email'   => 'required|email|unique:users',
            'password' => 'required',
            'work_type' => 'required|in:freelancer,contract',
            'admin' => 'required|in:0,1',
            'status' => 'required|in:active,inactive',
            'photo'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validateErrors->fails()) {
            return response()->json(['status' => 201, 'message' => $validateErrors->errors()->first()]);
        } // end if fails .
        
        $userDetails = $request->only([
            'name',
            'email',
            'work_type',
            'admin',
            'status'
        ]);

        if($request->hasFile('photo'))
            $userDetails['photo'] = $this->imageUpload($request['photo'],"user");

        $user = $this->basicRepository->create($this->model,$userDetails);
        
        return response()->json([
            "status"=>200,"message"=>"success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $user = $this->basicRepository->getById($this->model,$id);
        return view('user/show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->basicRepository->getById($this->model,$id);
        return view('user/create',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validateErrors = Validator::make($request->all(), [
            'name'   => 'required|max:250',
            'gender' => 'required|in:male,female',
            'birthday'   => 'required|date|date_format:Y-m-d',
            'photo'  => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        if ($validateErrors->fails()) {
            return response()->json(['status' => 201, 'message' => $validateErrors->errors()->first()]);
        } // end if fails .

        $patientDetails = $request->only([
            'name',
            'gender',
            'birthday',
            'description',
        ]);

        if($request->hasFile('photo'))
            $patientDetails['photo'] = $this->imageUpload($request['photo'],"Patient",$patient);
        // get the object
        $patient = $this->basicRepository->getById($this->patient,$id);

        $patient = $this->basicRepository->update($this->patient, $id, $patientDetails);
        
        return response()->json(["status"=>200,"message"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDetails = [
            'status'=> 'inactive'
        ];

        $user = $this->basicRepository->update($this->model, $id, $userDetails);

        return redirect()->intended('user');
    }



    public function getAdmin(){
            return "admin";
    }

    public function getRepresentative(){
        return "Representative";
    }
}
    