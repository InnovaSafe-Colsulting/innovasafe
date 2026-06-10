<?php

namespace App\Services;

use App\Interfaces\TypeServiceRepositoryInterface;
use App\Interfaces\TypeServiceServiceInterface;

class TypeServiceService implements TypeServiceServiceInterface
{
    public function __construct(
        private TypeServiceRepositoryInterface $typeServiceRepository
    ) {}

    public function getAll()
    {
        return $this->typeServiceRepository->getAll();
    }

    public function getActive()
    {
        return $this->typeServiceRepository->getActive();
    }

    public function getById(int $id)
    {
        return $this->typeServiceRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->typeServiceRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->typeServiceRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->typeServiceRepository->delete($id);
    }
}
