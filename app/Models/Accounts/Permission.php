<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Permission extends Model
{
    protected $fillable = [
        'name', 'title', 'desription', 'type', 'state', 'created_by', 'updated_by'
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
}
