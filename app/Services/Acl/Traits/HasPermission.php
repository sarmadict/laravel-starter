<?php

namespace App\Services\Acl\Traits;


use App\Models\Accounts\Permission;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait HasPermission
{
    /**
     * Get all the associated permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function permissions(): MorphToMany
    {
        return $this->morphToMany(Permission::class, 'permissible', config('acl.tables.permissible'));
    }

    /**
     * Get all permission names
     *
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        $cacheKey = property_exists($this, 'aclCacheKey') ? $this->aclCacheKey : $this->getTable();

        $config = config('acl.cache.' . $cacheKey);

        return cache()->remember($config['prefix'] . '.' . $this->getKey(), $config['expiration_time'], function () {
            return $this->permissions->pluck('name');
        });
    }
}