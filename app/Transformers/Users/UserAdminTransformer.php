<?php

namespace App\Transformers\Users;


use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class UserAdminTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $auth = Auth::user();

        return [
            'id' => (int)$user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'username' => $user->username,
            'mobile_number' => $user->mobile_number,
            'position' => $user->position,
            'j_created_at' => (string)$user->j_created_at,
            'j_approved_at' => (string)$user->j_approved_at,
            'state_name' => $user->state_name,
            'actions' => $this->getActions($auth, $user),
        ];
    }

    public function getActions($auth, $item)
    {
        $actions = "";

        if ($auth->can('adminUsersShow', $item)) {
            $actions .= '<a href="' . route('admin.users.show', $item) . '" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.show') . '">'
                . '<i class="fa fa-eye"></i> ' . trans('admin.default.actions.show')
                . '</a>';
        }

        if ($auth->can('adminUsersEdit', $item)) {
            $actions .= '<a href="' . route('admin.users.edit', $item) . '" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.edit') . '">'
                . '<i class="fa fa-pencil"></i> ' . trans('admin.default.actions.edit')
                . '</a>';
        }

        return $actions;
    }
}