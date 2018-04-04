<?php

namespace App\Http\Menus;


use App\Services\SimpleMenu\Menu;

class AdminPanelMenu extends Menu
{
    protected $menu = [
        [
            'name' => '1',
            'title' => '1',
            'permission' => 'permission.1',
            'route' => '',
            'class' => '',
            'icon' => '',
            'abstract' => true,
            'active_patterns'=> [],
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
                    'active_patterns'=> [],
                    'active_class' => '',
                    'sub_menu' => [
                        [
                            'name' => '1.1.1',
                            'title' => '1.1.1',
                            'permission' => 'permission.2',
                            'route' => '',
                            'class' => '',
                            'icon' => '',
                            'abstract' => true,
                            'active_patterns'=> [],
                            'active_class' => '',
                            'sub_menu' => [
                                [
                                    'name' => '1.1.1.1',
                                    'title' => 'Dashboard',
                                    'permission' => '',
                                    'route' => '',
                                    'class' => '',
                                    'icon' => '',
                                    'abstract' => false,
                                    'active_patterns'=> [],
                                    'active_class' => '',
                                    'sub_menu' => [

                                    ]
                                ],
                            ]
                        ],
                        [
                            'name' => '1.1.2',
                            'title' => '1.1.2',
                            'permission' => '',
                            'route' => '',
                            'class' => '',
                            'icon' => '',
                            'abstract' => false,
                            'active_patterns'=> [],
                            'active_class' => '',
                            'sub_menu' => [

                            ]
                        ],
                    ]
                ],
                [
                    'name' => '1.2',
                    'title' => '1.2',
                    'permission' => '',
                    'route' => '',
                    'class' => '',
                    'icon' => '',
                    'abstract' => false,
                    'active_patterns'=> [],
                    'active_class' => '',
                    'sub_menu' => [

                    ]
                ],
                [
                    'name' => '1.3',
                    'title' => '1.3',
                    'permission' => '',
                    'route' => '',
                    'class' => '',
                    'icon' => '',
                    'abstract' => false,
                    'active_patterns'=> [],
                    'active_class' => '',
                    'sub_menu' => [

                    ]
                ],
            ]
        ],
        [
            'name' => '2',
            'title' => '2',
            'permission' => '',
            'route' => '',
            'class' => '',
            'icon' => '',
            'abstract' => true,
            'active_patterns'=> [],
            'active_class' => '',
            'sub_menu' => [

            ]
        ],
    ];
}