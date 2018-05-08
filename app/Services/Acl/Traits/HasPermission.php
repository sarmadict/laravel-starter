<?php

namespace App\Services\Acl\Traits;


use App\Models\Permissions\Permission;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait HasPermission
{
    /**
     * Store permissions to prevent over requesting to cache store
     *
     * @var Collection
     */
    protected $loadedPermissions;

    /**
     * Determine if permissions are loaded or not
     *
     * @var bool
     */
    protected $arePermissionsLoaded = false;

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
        if (!$this->arePermissionsLoaded) {
            $this->loadedPermissions = $this->loadPermissions();

            $this->arePermissionsLoaded = true;
        }

        return $this->loadedPermissions;
    }

    /**
     * Load permissions from cache store
     *
     * @return mixed
     */
    public function loadPermissions(): Collection
    {
        $cacheKey = property_exists($this, 'aclCacheKey') ? $this->aclCacheKey : $this->getTable();

        $config = config('acl.cache.' . $cacheKey);

        return cache()->remember($config['prefix'] . '.' . $this->getKey(), $config['expiration_time'], function () {
            return $this->permissions()->pluck('name');
        });
    }
}