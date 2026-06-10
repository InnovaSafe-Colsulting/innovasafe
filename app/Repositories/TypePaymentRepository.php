<?php

namespace App\Repositories;

use App\Interfaces\TypePaymentRepositoryInterface;
use App\Models\TypePayment;

class TypePaymentRepository implements TypePaymentRepositoryInterface
{
    public function getAll()
    {
        return TypePayment::all();
    }

    public function getActive()
    {
        return TypePayment::where('status', '1')->get();
    }

    public function getById(int $id)
    {
        return TypePayment::findOrFail($id);
    }

    public function create(array $data)
    {
        return TypePayment::create($data);
    }

    public function update(int $id, array $data)
    {
        $typePayment = TypePayment::findOrFail($id);
        $typePayment->update($data);
        return $typePayment;
    }

    public function delete(int $id)
    {
        return TypePayment::findOrFail($id)->delete();
    }
}
