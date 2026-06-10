<?php

namespace App\Http\Controllers;

use App\Interfaces\CountryServiceInterface;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(
        private CountryServiceInterface $countryService
    ) {}

    public function index()
    {
        $countries = $this->countryService->getAll();
        return response()->json($countries);
    }

    public function show(int $id)
    {
        $country = $this->countryService->getById($id);
        return response()->json($country);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:80',
            'status' => 'in:1,0',
        ]);

        $country = $this->countryService->create($data);
        return response()->json($country, 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'string|max:80',
            'status' => 'in:1,0',
        ]);

        $country = $this->countryService->update($id, $data);
        return response()->json($country);
    }

    public function destroy(int $id)
    {
        $this->countryService->delete($id);
        return response()->json(null, 204);
    }
}
