<?php

namespace App\Services;

use App\Interfaces\TypePaymentDetailRepositoryInterface;
use App\Interfaces\TypePaymentDetailServiceInterface;

class TypePaymentDetailService implements TypePaymentDetailServiceInterface
{
    public function __construct(
        private TypePaymentDetailRepositoryInterface $detailRepository
    ) {}

    public function getAll()
    {
        return $this->detailRepository->getAll();
    }

    public function getActive()
    {
        return $this->detailRepository->getActive();
    }

    public function getById(int $id)
    {
        return $this->detailRepository->getById($id);
    }

    public function getByPaymentId(int $paymentId)
    {
        return $this->detailRepository->getByPaymentId($paymentId);
    }

    public function create(array $data)
    {
        return $this->detailRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->detailRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->detailRepository->delete($id);
    }
}
