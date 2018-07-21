<?php

namespace App\Models\Permissions;

use App\Models\BaseModel;
use App\Models\Traits\HasCreatorAndUpdater;
use App\Models\Traits\HasJalaliTimestamps;
use App\Models\Traits\HasState;

class Permission extends BaseModel
{
    use PermissionRelationships, PermissionScopes, PermissionModifiers,
        HasState, HasJalaliTimestamps, HasCreatorAndUpdater;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description', 'type', 'state', 'created_by', 'updated_by'
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

        $this->setTable(config('acl.tables.permissions'));
    }
}
