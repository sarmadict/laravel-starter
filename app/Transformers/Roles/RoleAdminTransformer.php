<?php

namespace App\Transformers\Roles;


use App\Models\Roles\Role;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class RoleAdminTransformer extends TransformerAbstract
{
    public function transform(Role $role)
    {
        $auth = Auth::user();

        return [
            'id' => (int)$role->id,
            'name' => $role->name,
            'title' => $role->title,
            'j_created_at' => (string)$role->j_created_at,
            'description_excerpt' => $role->description_excerpt,
            'state_name' => $role->state_name,
            'actions' => $this->getActions($auth, $role),
        ];
    }

    public function getActions($auth, $item)
    {
        $actions = "";

        if ($auth->can('adminRolesShow', $item)) {
            $actions .= '<a href="' . route('admin.roles.show', $item) . '" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.show') . '">'
                . '<i class="fa fa-eye"></i> ' . trans('admin.default.actions.show')
                . '</a>';
        }

        if ($auth->can('adminRolesEdit', $item)) {
            $actions .= '<a href="' . route('admin.roles.edit', $item) . '" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.edit') . '">'
                . '<i class="fa fa-pencil"></i> ' . trans('admin.default.actions.edit')
                . '</a>';
        }

        return $actions;
    }
}