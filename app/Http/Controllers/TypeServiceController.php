<?php

namespace App\Http\Controllers;

use App\Interfaces\TypeServiceServiceInterface;
use Illuminate\Http\Request;

class TypeServiceController extends Controller
{
    public function __construct(
        private TypeServiceServiceInterface $typeServiceService
    ) {}

    public function index()
    {
        return response()->json($this->typeServiceService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->typeServiceService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service' => 'required|string|max:100',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->typeServiceService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'service' => 'string|max:100',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->typeServiceService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->typeServiceService->delete($id);
        return response()->json(null, 204);
    }
}
