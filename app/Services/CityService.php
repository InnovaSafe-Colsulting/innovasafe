<?php

namespace App\Services;

use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CityServiceInterface;

class CityService implements CityServiceInterface
{
    public function __construct(
        private CityRepositoryInterface $cityRepository
    ) {}

    public function getAll()
    {
        return $this->cityRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->cityRepository->getById($id);
    }

    public function getByCountryId(int $countryId)
    {
        return $this->cityRepository->getByCountryId($countryId);
    }

    public function create(array $data)
    {
        return $this->cityRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->cityRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->cityRepository->delete($id);
    }
}
