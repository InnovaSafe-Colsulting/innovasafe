<?php

namespace App\Services;

use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\CountryServiceInterface;

class CountryService implements CountryServiceInterface
{
    public function __construct(
        private CountryRepositoryInterface $countryRepository
    ) {}

    public function getAll()
    {
        return $this->countryRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->countryRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->countryRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->countryRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->countryRepository->delete($id);
    }
}
