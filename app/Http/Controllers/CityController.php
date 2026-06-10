<?php

namespace App\Http\Controllers;

use App\Interfaces\CityServiceInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(
        private CityServiceInterface $cityService
    ) {}

    public function index()
    {
        return response()->json($this->cityService->getAll());
    }

    public function show(int $id)
    {
        return response()->json($this->cityService->getById($id));
    }

    public function getByCountry(int $countryId)
    {
        return response()->json($this->cityService->getByCountryId($countryId));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80',
            'country_id' => 'required|exists:countries,id',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->cityService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string|max:80',
            'country_id' => 'exists:countries,id',
            'status' => 'in:1,0',
        ]);

        return response()->json($this->cityService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->cityService->delete($id);
        return response()->json(null, 204);
    }
}
