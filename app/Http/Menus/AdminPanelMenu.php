<?php

namespace App\Http\Menus;


use App\Services\SimpleMenu\Menu;

class AdminPanelMenu extends Menu
{
    public function getItems()
    {
        return [
            [
                'name' => 'admin.dashboard',
                'title' => trans('admin.menu.dashboard.menu_title'),
                'permission' => 'admin.dashboard.index',
                'route' => route('admin.dashboard.index'),
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
                'name' => 'admin.settings',
                'title' => trans('admin.menu.settings.menu_title'),
                'permission' => false,
                'route' => 'javascript::void(0)',
                'class' => '',
                'icon' => 'fa fa-cog',
                'abstract' => true,
                'active_patterns' => [
                    'admin/general/settings*',
                ],
                'active_class' => 'active open',
                'sub_menu' => [
                    [
                        'name' => 'admin.settings_general',
                        'title' => trans('admin.menu.settings_general.menu_title'),
                        'permission' => false,
                        'route' => route('admin.settings.edit', 'general'),
                        'class' => '',
                        'icon' => 'fa fa-cog',
                        'abstract' => true,
                        'active_patterns' => [
                            'admin/general/settings/general*',
                        ],
                        'active_class' => 'active open',
                    ],
                ],
            ],
            [
                'name' => 'admin.categories',
                'title' => trans('admin.menu.categories.menu_title'),
                'permission' => 'admin.categories.index',
                'route' => route('admin.categories.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin/general/categories*'
                ],
                'active_class' => 'active open',
                'sub_menu' => [],
            ],
            [
                'name' => 'admin.posts',
                'title' => trans('admin.menu.posts.menu_title'),
                'permission' => 'admin.posts.index',
                'route' => route('admin.posts.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin/blog/posts*'
                ],
                'active_class' => 'active open',
                'sub_menu' => [],
            ],
            [
                'name' => 'admin.users',
                'title' => trans('admin.menu.users.menu_title'),
                'permission' => 'admin.users.index',
                'route' => route('admin.users.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin/accounts/users*'
                ],
                'active_class' => 'active open',
                'sub_menu' => [],
            ],
            [
                'name' => 'admin.roles',
                'title' => trans('admin.menu.roles.menu_title'),
                'permission' => 'admin.roles.index',
                'route' => route('admin.roles.index'),
                'class' => '',
                'icon' => 'fa fa-check',
                'abstract' => false,
                'active_patterns' => [
                    'admin/accounts/roles*'
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