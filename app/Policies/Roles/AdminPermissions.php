<?php

namespace App\Policies\Roles;


use App\Models\Roles\Role;
use App\Models\Users\User;

trait AdminPermissions
{
    public function adminRolesIndex(User $user)
    {
        $permission = 'admin.roles.index';

        return $user->getPermissions()->contains($permission);
    }

    public function adminRolesCreate(User $user)
    {
        $permission = 'admin.roles.create';

        return $user->getPermissions()->contains($permission);
    }

    public function adminRolesShow(User $user, Role $role)
    {
        $permission = 'admin.roles.show';

        return $user->getPermissions()->contains($permission);
    }

    public function adminRolesEdit(User $user, Role $role)
    {
        $permission = 'admin.roles.edit';

        return $user->getPermissions()->contains($permission);
    }

    public function adminRolesDelete(User $user, Role $role)
    {
        $permission = 'admin.roles.delete';

        return $user->getPermissions()->contains($permission);
    }
}