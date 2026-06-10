<?php

namespace App\Repositories;

use App\Interfaces\ConfigurationCompanyRepositoryInterface;
use App\Models\ConfigurationCompany;

class ConfigurationCompanyRepository implements ConfigurationCompanyRepositoryInterface
{
    public function getAll()
    {
        return ConfigurationCompany::where('status', '1')->get();
    }

    public function getById(int $id)
    {
        return ConfigurationCompany::findOrFail($id);
    }

    public function getByName(string $name)
    {
        return ConfigurationCompany::where('name', $name)->first();
    }

    public function create(array $data)
    {
        return ConfigurationCompany::create($data);
    }

    public function update(int $id, array $data)
    {
        $config = ConfigurationCompany::findOrFail($id);
        $config->update($data);
        return $config;
    }

    public function delete(int $id)
    {
        return ConfigurationCompany::findOrFail($id)->delete();
    }
}
