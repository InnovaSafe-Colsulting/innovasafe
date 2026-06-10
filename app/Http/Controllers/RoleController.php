<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleServiceInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        private RoleServiceInterface $roleService
    ) {}

    public function index()
    {
        return response()->json($this->roleService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->roleService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'role' => 'required|string|max:80',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->roleService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'role' => 'string|max:80',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->roleService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->roleService->delete($id);
        return response()->json(null, 204);
    }
}
