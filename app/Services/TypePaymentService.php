<?php

namespace App\Services;

use App\Interfaces\TypePaymentRepositoryInterface;
use App\Interfaces\TypePaymentServiceInterface;

class TypePaymentService implements TypePaymentServiceInterface
{
    public function __construct(
        private TypePaymentRepositoryInterface $typePaymentRepository
    ) {}

    public function getAll()
    {
        return $this->typePaymentRepository->getAll();
    }

    public function getActive()
    {
        return $this->typePaymentRepository->getActive();
    }

    public function getById(int $id)
    {
        return $this->typePaymentRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->typePaymentRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->typePaymentRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->typePaymentRepository->delete($id);
    }
}
