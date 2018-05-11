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
        return $this->morphedByMany(Role::class, 'permissible', config('acl.tables.permissible'))
            ->withPivot(['assigned_by', 'assigned_at']);
    }

    /**
     * Get Users associated with this permission
     *
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'permissible', config('acl.tables.permissible'))
            ->withPivot(['assigned_by', 'assigned_at']);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id', 'creator');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id', 'approver');
    }
}