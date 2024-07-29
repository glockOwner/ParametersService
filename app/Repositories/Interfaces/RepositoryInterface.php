<?php

namespace App\Repositories\Interfaces;

use App\Models\Parameter;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    public function getAll(): \Illuminate\Database\Eloquent\Collection;
    public function getById(string $id): Parameter|null;
    public function getByName(string $name): Parameter|null;
    public function getWithFilter($filter): ?LengthAwarePaginator;
}
