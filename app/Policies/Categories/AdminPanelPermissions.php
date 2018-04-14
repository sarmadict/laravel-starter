<?php

namespace App\Policies\Categories;


use App\Models\Accounts\User;

trait AdminPanelPermissions
{
    public function panelAdminCategoriesIndex(User $user)
    {
        $permission = 'panel.admin.categories.index';

        return $user->getPermissions()->contains($permission);
    }
}