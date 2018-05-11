<?php

namespace App\Modules\Admin\Roles\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Roles\Role;
use App\Repositories\Roles\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RolesTableController extends AdminBaseController
{
    protected $roles;

    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    public function __invoke(Request $request)
    {
        $this->authorize('adminRolesIndex', Role::class);

        $auth = $request->user();

        return DataTables::of($this->roles->getAdminDataTable())
            ->removeColumn('state')
            ->removeColumn('description')
            ->addColumn('j_created_at', function ($item) {
                return $item->j_published_at;
            })
            ->addColumn('description_excerpt', function ($item) {
                return $item->description_excerpt;
            })
            ->addColumn('state_name', function ($item) {
                return $item->state_name;
            })
            ->addColumn('actions', function ($item) use ($auth) {
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
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
