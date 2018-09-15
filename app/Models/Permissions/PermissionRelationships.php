<?php

namespace App\Models\Permissions;


use App\Models\Roles\Role;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait PermissionRelationships
{
    /**
     * Get Roles associated with this permission
     *
     * @return MorphToMany
     */
    public function roles(): MorphToMany
    {
        return $this->morphedByMany(Role::class, 'permissible', config('tables.permissible'))
            ->withPivot(['assigned_by', 'assigned_at']);
    }

    /**
     * Get Users associated with this permission
     *
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'permissible', config('tables.permissible'))
            ->withPivot(['assigned_by', 'assigned_at']);
    }
}