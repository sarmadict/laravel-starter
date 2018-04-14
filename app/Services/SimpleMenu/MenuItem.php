<?php

namespace App\Services\SimpleMenu;


use HieuLe\Active\Facades\Active;

class MenuItem
{
    public $name;

    public $title;

    public $permission;

    public $route;

    public $icon;

    public $isAbstract;

    public $subMenu;

    public $activePatterns;

    public $activeClass;

    public function __construct($name, $title, $permission = '', $route = '', $icon = '', $isAbstract = false, $activePatterns = [], $activeClass = 'active')
    {
        $this->name = $name;

        $this->title = $title;

        $this->route = $route;

        $this->icon = $icon;

        $this->permission = $permission;

        $this->isAbstract = $isAbstract;

        $this->subMenu = [];

        $this->activePatterns = $activePatterns;

        $this->activeClass = $activeClass;
    }

    public function addSubMenu(MenuItem $menuItem)
    {
        array_push($this->subMenu, $menuItem);
    }

    public function setSubMenu($subMenu)
    {
        $this->subMenu = $subMenu;

        return $this;
    }

    public function getSubMenu()
    {
        return $this->subMenu;
    }

    public function hasSubMenu()
    {
        return count($this->subMenu) > 0;
    }

    public function isAbstract()
    {
        return $this->isAbstract;
    }

    public function isActive()
    {
        return count($this->activePatterns) ? Active::checkUriPattern($this->activePatterns) : false;
    }

    public function getActiveClass()
    {
        return $this->activeClass ?: 'active';
    }

    public function showActiveClass($activeClass = null)
    {
        $activeClass = $activeClass ?: $this->getActiveClass();

        return $this->isActive() ? $activeClass : '';
    }
}