<?php

namespace App\Repositories;

use App\Interfaces\TypePaymentDetailRepositoryInterface;
use App\Models\TypePaymentDetail;

class TypePaymentDetailRepository implements TypePaymentDetailRepositoryInterface
{
    public function getAll()
    {
        return TypePaymentDetail::with('typePayment')->get();
    }

    public function getActive()
    {
        return TypePaymentDetail::where('status', '1')->with('typePayment')->get();
    }

    public function getById(int $id)
    {
        return TypePaymentDetail::findOrFail($id);
    }

    public function getByPaymentId(int $paymentId)
    {
        return TypePaymentDetail::where('id_payment_detail', $paymentId)->first();
    }

    public function create(array $data)
    {
        return TypePaymentDetail::create($data);
    }

    public function update(int $id, array $data)
    {
        $detail = TypePaymentDetail::findOrFail($id);
        $detail->update($data);
        return $detail;
    }

    public function delete(int $id)
    {
        return TypePaymentDetail::findOrFail($id)->delete();
    }
}
