<?php

namespace App\Modules\Admin\Users\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersTableController extends AdminBaseController
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function __invoke(Request $request)
    {
        $this->authorize('adminUsersIndex', User::class);

        $auth = $request->user();

        return DataTables::of($this->users->getAdminDataTable())
            ->removeColumn('state')
            ->addColumn('j_created_at', function ($item) {
                return $item->j_created_at;
            })
            ->addColumn('j_approved_at', function ($item) {
                return $item->j_approved_at;
            })
            ->addColumn('state_name', function ($item) {
                return $item->state_name;
            })
            ->addColumn('actions', function ($item) use ($auth) {
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
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
