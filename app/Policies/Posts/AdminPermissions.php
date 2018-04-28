<?php

namespace App\Policies\Posts;


use App\Models\Accounts\User;
use App\Models\Posts\Post;

trait AdminPermissions
{
    public function adminPostsIndex(User $user)
    {
        $permission = 'admin.posts.index';

        return $user->getPermissions()->contains($permission);
    }

    public function adminPostsCreate(User $user)
    {
        $permission = 'admin.posts.create';

        return $user->getPermissions()->contains($permission);
    }

    public function adminPostsShow(User $user, Post $post)
    {
        $permission = 'admin.posts.show';

        return $user->getPermissions()->contains($permission);
    }

    public function adminPostsEdit(User $user, Post $post)
    {
        $permission = 'admin.posts.edit';

        return $user->getPermissions()->contains($permission);
    }

    public function adminPostsDelete(User $user, Post $post)
    {
        $permission = 'admin.posts.delete';

        return $user->getPermissions()->contains($permission);
    }
}