<?php

namespace App\Services\Acl\Traits;


use App\Models\Accounts\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRole
{
    /**
     * Get related roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, config('acl.tables.role_user'), 'user_id', 'role_id', 'id', 'id', 'roles');
    }
}