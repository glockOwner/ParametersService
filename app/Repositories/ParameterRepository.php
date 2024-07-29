<?php

namespace App\Repositories;

use App\Models\Parameter;
use Illuminate\Pagination\LengthAwarePaginator;

class ParameterRepository
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Parameter::all();
    }

    public function getById(string $id): Parameter|null
    {
        return Parameter::find($id);
    }

    public function getByName(string $name): Parameter|null
    {
        return Parameter::where('name', $name)->first();
    }

    public function getWithFilter($filter): ?LengthAwarePaginator
    {
        return Parameter::filter($filter)->paginate(10);
    }
}
