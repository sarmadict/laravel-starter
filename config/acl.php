<?php

return [
    'models' => [
        'permission' => 'Permission',

        'role' => 'Role',
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