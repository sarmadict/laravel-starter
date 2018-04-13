<?php

namespace App\Http\Menus;


use App\Services\SimpleMenu\Menu;

class AdminPanelMenu extends Menu
{
    public function getItems()
    {
        return [
            [
                'name' => 'panel.admin.general.main',
                'title' => trans('panel.admin.general.categories.menu_title'),
                'permission' => 'panel.admin.general.categories.index',
                'route' => route(''),
                'class' => '',
                'icon' => '',
                'abstract' => true,
                'active_patterns' => [],
                'active_class' => '',
                'sub_menu' => [
                    [
                        'name' => '1.1',
                        'title' => '1.1',
                        'permission' => '',
                        'route' => '',
                        'class' => '',
                        'icon' => '',
                        'abstract' => false,
                        'active_patterns' => [],
                        'active_class' => '',
                        'sub_menu' => [
                        ]
                    ],
                ]
            ],
        ];
    }
}