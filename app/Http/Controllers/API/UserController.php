<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Resources\UserResource;


class UserController extends BaseController
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->middleware('auth:sanctum');
        $this->basicRepository = $basicRepository;
        $this->model = new User;
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representative_id = Auth::user()->id;

        $doctors = Doctor::where('assign_to',$representative_id)
                            ->where('status_doctor','active')
                            ->get();

        return $this->sendResponse($doctors , 'Return Doctors successfully.'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "no action3";
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
                       ->where('phone', $request['phone'])
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
        $doctorDetails['assign_to'] = Auth::user()->id;
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
		$user = $this->basicRepository->getById($this->model,$id);
        return $this->sendResponse(new UserResource($user) , 'Return User successfully.');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return "no action1";
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
                       ->ignore($id)
                       ->where('phone', $request['phone'])
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

    /**
     * Search the doctors by phone or website or doctor name or center name and return doctors name and center name 
    */
    public function profile(Request $request)
    {
        $user = Auth::user(); 
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

           Image::make($request->photo)->save(storage_path('app\public\profile\\'.$name));
            $request->merge(['photo' => $name]);

            $userPhoto = '/storage/profile/'.$name;


            $user->fill(array("profile_photo"=>$userPhoto))->save();
            
            $user = User::whereId($user->id)->first();

            return $this->sendResponse($user , 'Profile photo updated successfully.');
    }



}
