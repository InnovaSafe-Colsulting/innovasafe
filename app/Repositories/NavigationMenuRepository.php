<?php

namespace App\Repositories;

use App\Interfaces\NavigationMenuRepositoryInterface;
use App\Models\NavigationMenu;

class NavigationMenuRepository implements NavigationMenuRepositoryInterface
{
    public function getAll()
    {
        return NavigationMenu::orderBy('position')->get();
    }

    public function getActive()
    {
        return NavigationMenu::where('status', '1')
            ->whereNull('parent_id')
            ->orderBy('position')
            ->with('children')
            ->get();
    }

    public function getById(int $id)
    {
        return NavigationMenu::findOrFail($id);
    }

    public function create(array $data)
    {
        return NavigationMenu::create($data);
    }

    public function update(int $id, array $data)
    {
        $menu = NavigationMenu::findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    public function delete(int $id)
    {
        return NavigationMenu::findOrFail($id)->delete();
    }
}
