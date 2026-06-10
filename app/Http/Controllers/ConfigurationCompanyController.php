<?php

namespace App\Http\Controllers;

use App\Interfaces\ConfigurationCompanyServiceInterface;
use Illuminate\Http\Request;

class ConfigurationCompanyController extends Controller
{
    public function __construct(
        private ConfigurationCompanyServiceInterface $configService
    ) {}

    public function index()
    {
        return response()->json($this->configService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->configService->getById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'value' => 'string',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->configService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string|max:100',
            'value' => 'string',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->configService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->configService->delete($id);
        return response()->json(null, 204);
    }
}
