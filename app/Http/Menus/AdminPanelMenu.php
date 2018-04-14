<?php

namespace App\Http\Menus;


use App\Services\SimpleMenu\Menu;

class AdminPanelMenu extends Menu
{
    public function getItems()
    {
        return [
            [
                'name' => 'panel.admin.dashboard',
                'title' => trans('menu.panel.admin.dashboard.menu_title'),
                'permission' => 'panel.admin.dashboard.index',
                'route' => route('panel.admin.dashboard.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin',
                    'admin/dashboard*',
                ],
                'active_class' => 'active open',
                'sub_menu' => [],
            ],
            [
                'name' => 'panel.admin.categories',
                'title' => trans('menu.panel.admin.categories.menu_title'),
                'permission' => 'panel.admin.categories.index',
                'route' => route('panel.admin.categories.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin/general/categories*'
                ],
                'active_class' => 'active open',
                'sub_menu' => [],
            ],

            /**
            [
            'name' => 'panel.admin.general.categories',
            'title' => trans('menu.panel.admin.general.categories.menu_title'),
            'permission' => 'panel.admin.general.categories.index',
            'route' => route('panel.admin.general.categories.index'),
            'class' => '',
            'icon' => 'ti-layout-grid-2',
            'abstract' => false,
            'active_patterns' => [
            'admin/general/categories/*'
            ],
            'active_class' => 'active',
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
             */
        ];
    }
}