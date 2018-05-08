<?php

namespace App\Models\Roles;


use App\Models\Users\User;

trait RoleRelationships
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}