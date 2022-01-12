<?php

namespace App\Repositories;

use App\Interfaces\BasicRepositoryInterface;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;

class BasicRepository implements BasicRepositoryInterface 
{
    public function getAll($model) 
    {
        return $model::all();
    }

    public function getById($model, $id) 
    {
        return $model::findOrFail($id);
    }

    public function delete($model, $id) 
    {
        $model::destroy($id);
    }

    public function create($model, array $details) 
    {

        return $model::create($details);
    }

    public function update($model, $id, array $newDetails) 
    {
        $model::whereId($id)->update($newDetails);
        return $model::whereId($id)->first();
    }
}