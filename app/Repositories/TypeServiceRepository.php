<?php

namespace App\Repositories;

use App\Interfaces\TypeServiceRepositoryInterface;
use App\Models\TypeService;

class TypeServiceRepository implements TypeServiceRepositoryInterface
{
    public function getAll()
    {
        return TypeService::all();
    }

    public function getActive()
    {
        return TypeService::where('status', '1')->get();
    }

    public function getById(int $id)
    {
        return TypeService::findOrFail($id);
    }

    public function create(array $data)
    {
        return TypeService::create($data);
    }

    public function update(int $id, array $data)
    {
        $typeService = TypeService::findOrFail($id);
        $typeService->update($data);
        return $typeService;
    }

    public function delete(int $id)
    {
        return TypeService::findOrFail($id)->delete();
    }
}
