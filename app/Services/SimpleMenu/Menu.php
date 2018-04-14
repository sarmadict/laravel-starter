<?php

namespace App\Services\SimpleMenu;


use Illuminate\Contracts\Auth\Access\Gate;

abstract class Menu
{
    protected $gate;

    public function __construct(Gate $gate)
    {
        \Log::info(3);
        $this->gate = $gate;
    }

    public function get()
    {
        return $this->processMenu($this->getItems());
    }

    public function processMenu($menu)
    {
        return collect($menu)
            ->map(function ($item) {
                if ($this->isValidMenuItem($item)) {
                    return $this->getMenuItem($item);
                }
            })
            ->filter();
    }

    public function getMenuItem($menuItemData)
    {
        $menuItem = new MenuItem(
            $menuItemData['name'], $menuItemData['title'], $menuItemData['permission'],
            $menuItemData['route'], $menuItemData['icon'], $menuItemData['abstract'],
            $menuItemData['active_patterns'], $menuItemData['active_class']
        );

        $subMenu = $this->processMenu(array_get($menuItemData, 'sub_menu', []));

        $menuItem->setSubMenu($subMenu);

        return $menuItem;
    }

    public function isValidMenuItem($menuItem)
    {
        $permission = array_get($menuItem, 'permission', null);

        return $permission ? $this->gate->allows($permission) : true;
    }

    public abstract function getItems();
}