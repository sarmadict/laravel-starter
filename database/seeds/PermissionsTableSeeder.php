<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'admin.dashboard.index',

            'admin.settings_general.edit',

            'admin.users.index',
            'admin.users.create',
            'admin.users.show',
            'admin.users.edit',
            'admin.users.delete',

            'admin.posts.index',
            'admin.posts.create',
            'admin.posts.show',
            'admin.posts.edit',
            'admin.posts.delete',

            'admin.categories.index',
            'admin.categories.create',
            'admin.categories.show',
            'admin.categories.edit',
            'admin.categories.delete',

            'admin.roles.index',
            'admin.roles.create',
            'admin.roles.show',
            'admin.roles.edit',
            'admin.roles.delete',

        ];

        $system = \App\Models\Users\User::query()->find(1);
        $superadmin = \App\Models\Users\User::query()->find(2);


        foreach ($permissions as $permissionName) {
            $permission = \App\Models\Permissions\Permission::query()->firstOrCreate(
                ['name' => $permissionName],
                [
                    'title' => $permissionName,
                    'type' => \App\Services\Acl\Types\Permission::PRIMARY,
                    'state' => \App\Types\State::ENABLED
                ]
            );

            $system->permissions()->syncWithoutDetaching([$permission->id]);
            $superadmin->permissions()->syncWithoutDetaching([$permission->id]);
        }

        $system->clearPermissionsCache();
        $superadmin->clearPermissionsCache();
    }
}
