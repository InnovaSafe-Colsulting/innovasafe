<?php

namespace App\Services;

use App\Interfaces\ContactRepositoryInterface;
use App\Interfaces\ContactServiceInterface;

class ContactService implements ContactServiceInterface
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {}

    public function getAll()
    {
        return $this->contactRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->contactRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->contactRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->contactRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->contactRepository->delete($id);
    }
}
