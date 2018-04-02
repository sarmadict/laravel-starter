<?php


namespace App\Services\Acl;


use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Authenticatable;

class PermissionRegistrar
{
    protected $gate;

    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    public function registerPermissions()
    {
        $this->gate->before(function (Authenticatable $user, $ability){
            return $user->hasPermissionTo($ability);
        });
    }
}