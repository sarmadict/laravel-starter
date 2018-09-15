<?php

namespace App\Models\Roles;

use App\Models\BaseModel;
use App\Models\Traits\HasCreatorAndUpdater;
use App\Models\Traits\HasJalaliTimestamps;
use App\Models\Traits\HasState;
use App\Services\Acl\Traits\HasPermission;

class Role extends BaseModel
{
    use HasPermission, RoleRelationships, RoleScopes, RoleModifiers,
        HasState, HasJalaliTimestamps, HasCreatorAndUpdater;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description', 'state', 'created_by', 'updated_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('tables.roles'));
    }

    public function hasPermissionTo($ability)
    {
        return $this->getPermissions()->contains($ability);
    }
}
