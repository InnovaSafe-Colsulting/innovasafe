<?php

namespace App\Services;

use App\Interfaces\ConfigurationCompanyRepositoryInterface;
use App\Interfaces\ConfigurationCompanyServiceInterface;

class ConfigurationCompanyService implements ConfigurationCompanyServiceInterface
{
    public function __construct(
        private ConfigurationCompanyRepositoryInterface $configRepository
    ) {}

    public function getAll()
    {
        return $this->configRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->configRepository->getById($id);
    }

    public function getByName(string $name)
    {
        return $this->configRepository->getByName($name);
    }

    public function create(array $data)
    {
        return $this->configRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->configRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->configRepository->delete($id);
    }
}
