<?php

namespace App\Interfaces;

interface CityServiceInterface
{
    public function getAll();
    public function getById(int $id);
    public function getByCountryId(int $countryId);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
