<?php

namespace App\Http\Controllers;

use App\Interfaces\NavigationMenuServiceInterface;
use Illuminate\Http\Request;

class NavigationMenuController extends Controller
{
    public function __construct(
        private NavigationMenuServiceInterface $menuService
    ) {}

    public function index()
    {
        return response()->json($this->menuService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->menuService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label' => 'required|string|max:150',
            'url' => 'string',
            'position' => 'integer',
            'status' => 'in:1,0',
            'parent_id' => 'nullable|exists:navigation_menu,id',
        ]);

        return response()->json($this->menuService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'label' => 'string|max:150',
            'url' => 'string',
            'position' => 'integer',
            'status' => 'in:1,0',
            'parent_id' => 'nullable|exists:navigation_menu,id',
        ]);

        return response()->json($this->menuService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->menuService->delete($id);
        return response()->json(null, 204);
    }
}
