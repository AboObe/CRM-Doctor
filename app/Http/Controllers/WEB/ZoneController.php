<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Interfaces\BasicRepositoryInterface;
use DataTables;
use Validator;

class ZoneController extends Controller
{
    private BasicRepositoryInterface $basicRepository;
    private $model;

    public function __construct(BasicRepositoryInterface $basicRepository)
    {
        $this->basicRepository = $basicRepository;
        $this->model = new Zone;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return "no action index zone";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "no action create zone";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zoneDetails = $request->only([
            'city',
            'region',
            'country',
            'representative_id'
        ]);

        $zone = $this->basicRepository->create($this->model,$zoneDetails);
        
        return $zone; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $zoneDetails = $request->only([
            'city',
            'region',
            'country',
            'representative_id'
        ]);

        $zone = $this->basicRepository->getById($this->model,$id);

        $zone = $this->basicRepository->update($this->model, $id, $zoneDetails);
        
        return $zone; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->basicRepository->delete($this->model,$id);
    }
}
    