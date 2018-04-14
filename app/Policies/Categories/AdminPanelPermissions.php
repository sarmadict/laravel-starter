<?php

namespace App\Policies\Categories;


use App\Models\Accounts\User;
use App\Models\Categories\Category;

trait AdminPanelPermissions
{
    public function panelAdminCategoriesIndex(User $user)
    {
        $permission = 'panel.admin.categories.index';

        return $user->getPermissions()->contains($permission);
    }

    public function panelAdminCategoriesCreate(User $user)
    {
        $permission = 'panel.admin.categories.create';

        return $user->getPermissions()->contains($permission);
    }

    public function panelAdminCategoriesShow(User $user, Category $category)
    {
        $permission = 'panel.admin.categories.show';

        return $user->getPermissions()->contains($permission);
    }

    public function panelAdminCategoriesEdit(User $user, Category $category)
    {
        $permission = 'panel.admin.categories.edit';

        return $user->getPermissions()->contains($permission);
    }

    public function panelAdminCategoriesDelete(User $user, Category $category)
    {
        $permission = 'panel.admin.categories.delete';

        return $user->getPermissions()->contains($permission);
    }
}