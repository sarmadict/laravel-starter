<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use App\Repositories\Repository;
use App\Types\State;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleRepository extends Repository
{
    public function __construct(Role $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query();

        return $query;
    }

    public function createRole($data)
    {
        $auth = Auth::user();

        DB::beginTransaction();

        $item = $this->forceCreate([
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => array_get($data, 'description', null),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'created_by' => $auth->id,
            'updated_by' => $auth->id,
        ]);

        $item->permissions()->sync(array_get($data, 'permissions', []));

        DB::commit();

        return $item;
    }

    public function updateRole($item, $data)
    {
        $auth = Auth::user();

        DB::beginTransaction();

        $item = $this->forceUpdate($item, [
            'name' => $data['name'],
            'title' => $data['title'],
            'description' => array_get($data, 'description', null),
            'state' => array_has($data, 'state') ? State::ENABLED : State::DISABLED,
            'updated_by' => $auth->id,
        ]);

        $item->permissions()->sync(array_get($data, 'permissions', []));

        DB::commit();

        return $item;
    }
}