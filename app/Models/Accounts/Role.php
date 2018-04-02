<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use App\Services\Acl\Traits\HasPermission;

class Role extends Model
{
    use HasPermission;

    protected $fillable = ['name', 'title', 'description', 'state', 'created_by', 'updated_by'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('acl.tables.roles'));
    }

    public function hasPermissionTo($ability)
    {
        return $this->getPermissions()->contains($ability);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
