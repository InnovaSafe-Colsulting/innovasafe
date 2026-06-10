<?php

namespace App\Http\Controllers;

use App\Interfaces\TypePaymentDetailServiceInterface;
use Illuminate\Http\Request;

class TypePaymentDetailController extends Controller
{
    public function __construct(
        private TypePaymentDetailServiceInterface $detailService
    ) {}

    public function index()
    {
        return response()->json($this->detailService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->detailService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_payment_detail' => 'required|exists:type_payment,id',
            'agreement' => 'nullable|string|max:20',
            'reference' => 'nullable|string|max:80',
            'bank' => 'nullable|string|max:100',
            'account_type' => 'nullable|string|max:50',
            'account_number' => 'nullable|string|max:40',
            'holder' => 'nullable|string|max:100',
            'nit' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'value' => 'nullable|numeric',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->detailService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'id_payment_detail' => 'exists:type_payment,id',
            'agreement' => 'nullable|string|max:20',
            'reference' => 'nullable|string|max:80',
            'bank' => 'nullable|string|max:100',
            'account_type' => 'nullable|string|max:50',
            'account_number' => 'nullable|string|max:40',
            'holder' => 'nullable|string|max:100',
            'nit' => 'nullable|string|max:20',
            'cellphone' => 'nullable|string|max:20',
            'value' => 'nullable|numeric',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->detailService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->detailService->delete($id);
        return response()->json(null, 204);
    }
}
