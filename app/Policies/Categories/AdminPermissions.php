<?php

namespace App\Policies\Categories;


use App\Models\Users\User;
use App\Models\Categories\Category;

trait AdminPermissions
{
    public function adminCategoriesIndex(User $user)
    {
        $permission = 'admin.categories.index';

        return $user->getPermissions()->contains($permission);
    }

    public function adminCategoriesCreate(User $user)
    {
        $permission = 'admin.categories.create';

        return $user->getPermissions()->contains($permission);
    }

    public function adminCategoriesShow(User $user, Category $category)
    {
        $permission = 'admin.categories.show';

        return $user->getPermissions()->contains($permission);
    }

    public function adminCategoriesEdit(User $user, Category $category)
    {
        $permission = 'admin.categories.edit';

        return $user->getPermissions()->contains($permission);
    }

    public function adminCategoriesDelete(User $user, Category $category)
    {
        $permission = 'admin.categories.delete';

        return $user->getPermissions()->contains($permission);
    }
}