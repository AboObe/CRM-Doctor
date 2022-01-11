<?php

namespace App\Interfaces;

interface BasicRepositoryInterface 
{
    public function getAll($model);
    public function getById($model,$id);
    public function delete($model,$id);
    public function create($model,array $details);
    public function update($model, $id, array $newDetails);
}