<?php

namespace App\Repositories;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface
{
    public function getAll()
    {
        return Country::all();
    }

    public function getById(int $id)
    {
        return Country::findOrFail($id);
    }

    public function create(array $data)
    {
        return Country::create($data);
    }

    public function update(int $id, array $data)
    {
        $country = Country::findOrFail($id);
        $country->update($data);
        return $country;
    }

    public function delete(int $id)
    {
        return Country::findOrFail($id)->delete();
    }
}
