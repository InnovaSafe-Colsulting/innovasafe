<?php

namespace App\Interfaces;

interface ConfigurationCompanyServiceInterface
{
    public function getAll();
    public function getById(int $id);
    public function getByName(string $name);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
