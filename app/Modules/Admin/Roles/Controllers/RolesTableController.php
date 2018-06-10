<?php

namespace App\Modules\Admin\Roles\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Roles\Role;
use App\Repositories\Roles\RoleRepository;
use App\Transformers\Roles\RoleAdminTransformer;
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

        return DataTables::of($this->roles->getAdminDataTable())
            ->setTransformer(new RoleAdminTransformer())
            ->make(true);
    }
}
