<?php

namespace App\Services;

use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\RoleServiceInterface;

class RoleService implements RoleServiceInterface
{
    public function __construct(
        private RoleRepositoryInterface $roleRepository
    ) {}

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->roleRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->roleRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->roleRepository->delete($id);
    }
}
