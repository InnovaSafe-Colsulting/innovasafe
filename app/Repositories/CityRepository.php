<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;

class CityRepository implements CityRepositoryInterface
{
    public function getAll()
    {
        return City::all();
    }

    public function getById(int $id)
    {
        return City::findOrFail($id);
    }

    public function getByCountryId(int $countryId)
    {
        return City::where('country_id', $countryId)->get();
    }

    public function create(array $data)
    {
        return City::create($data);
    }

    public function update(int $id, array $data)
    {
        $city = City::findOrFail($id);
        $city->update($data);
        return $city;
    }

    public function delete(int $id)
    {
        return City::findOrFail($id)->delete();
    }
}
