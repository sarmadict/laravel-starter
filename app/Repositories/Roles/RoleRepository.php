<?php

namespace App\Repositories\Roles;

use App\Models\Roles\Role;
use App\Repositories\Repository;
use App\Types\State;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class RoleRepository extends Repository
{
    public function __construct(Role $model)
    {
        $this->setModel($model);
    }

    public function getAdminDatatable()
    {
        $query = $this->query()
            ->select([
                'roles.id',
                'roles.state',
                'roles.name',
                'roles.title',
                'roles.description',
                'roles.created_at',
            ]);

        return $query;
    }

    public function createRole($data)
    {
        try {
            $auth = Auth::user();

            DB::beginTransaction();

            $item =  $this->forceCreate([
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

        } catch (Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }

    public function updateRole($item, $data)
    {
        try {
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

        } catch (Exception $e) {
            \DB::rollBack();

            throw $e;
        }
    }
}