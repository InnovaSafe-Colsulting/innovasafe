<?php

namespace App\Services;

use App\Interfaces\NavigationMenuRepositoryInterface;
use App\Interfaces\NavigationMenuServiceInterface;

class NavigationMenuService implements NavigationMenuServiceInterface
{
    public function __construct(
        private NavigationMenuRepositoryInterface $menuRepository
    ) {}

    public function getAll()
    {
        return $this->menuRepository->getAll();
    }

    public function getActive()
    {
        return $this->menuRepository->getActive();
    }

    public function getById(int $id)
    {
        return $this->menuRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->menuRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->menuRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->menuRepository->delete($id);
    }
}
