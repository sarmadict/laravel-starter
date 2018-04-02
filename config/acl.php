<?php

return [
    'models' => [
        'permission' => 'Permission',

        'role' => 'Role',
    ],


    'tables' => [
        'roles' => 'roles',

        'permissions' => 'permissions',

        'permissible' => 'permissible',

        'role_user' => 'role_user',

    ],

    'cache' => [
        'users' => [
            'expiration_time' => 60,

            'prefix' => 'acl.users.'
        ],

        'roles' => [
            'expiration_time' => 60 * 10,

            'prefix' => 'acl.roles.'
        ]
    ]
];