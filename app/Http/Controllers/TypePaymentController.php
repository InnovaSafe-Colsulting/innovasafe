<?php

namespace App\Http\Controllers;

use App\Interfaces\TypePaymentServiceInterface;
use Illuminate\Http\Request;

class TypePaymentController extends Controller
{
    public function __construct(
        private TypePaymentServiceInterface $typePaymentService
    ) {}

    public function index()
    {
        return response()->json($this->typePaymentService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->typePaymentService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->typePaymentService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string|max:100',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->typePaymentService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->typePaymentService->delete($id);
        return response()->json(null, 204);
    }
}
