<?php

namespace App\Policies\Users;


use App\Models\Accounts\User;

trait AdminPermissions
{
    public function adminUsersIndex(User $user)
    {
        $permission = 'admin.users.index';

        return $user->getPermissions()->contains($permission);
    }

    public function adminUsersCreate(User $user)
    {
        $permission = 'admin.users.create';

        return $user->getPermissions()->contains($permission);
    }

    public function adminUsersShow(User $user, User $userItem)
    {
        $permission = 'admin.users.show';

        return $user->getPermissions()->contains($permission);
    }

    public function adminUsersEdit(User $user, User $userItem)
    {
        $permission = 'admin.users.edit';

        return $user->getPermissions()->contains($permission);
    }

    public function adminUsersDelete(User $user, User $userItem)
    {
        $permission = 'admin.users.delete';

        return $user->getPermissions()->contains($permission);
    }
}