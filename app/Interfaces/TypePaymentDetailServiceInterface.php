<?php

namespace App\Interfaces;

interface TypePaymentDetailServiceInterface
{
    public function getAll();
    public function getActive();
    public function getById(int $id);
    public function getByPaymentId(int $paymentId);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
