<?php

namespace App\Services\Acl\Traits;


trait CanAuthorize
{
    /**
     * Check user permission for any ability
     *
     * @param $ability
     * @return bool
     */
    function hasPermissionTo($ability)
    {
        if($this->getPermissions()->contains($ability)){
            return true;
        }

        foreach ($this->roles as $role){
            if($role->hasPermissionTo($ability)){
                return true;
            }
        }

        return null;
    }
}