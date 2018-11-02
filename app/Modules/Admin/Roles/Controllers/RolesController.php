<?php

namespace App\Modules\Admin\Roles\Controllers;


use App\Events\Roles\RoleCreated;
use App\Events\Roles\RoleUpdated;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Roles\Role;
use App\Modules\Admin\Roles\Forms\RoleForm;
use App\Modules\Admin\Roles\Requests\StoreRoleRequest;
use App\Modules\Admin\Roles\Requests\UpdateRoleRequest;
use App\Repositories\Roles\RoleRepository;
use App\Services\Alert\Facade\Alert;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class RolesController extends AdminBaseController
{
    protected $roles;

    /**
     * Crate Roles Controller Instance
     *
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Show index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('adminRolesIndex', Role::class);

        return view('admin.roles.index');
    }

    /**
     * Show Role creation form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('adminRolesCreate', Role::class);

        $form = FormBuilder::create(RoleForm::class, [
            'method' => 'POST',
            'url' => route('admin.roles.store'),
            'data' => [
                //
            ]
        ]);

        return view('admin.roles.form', compact('form'));
    }

    /**
     * Store new Role
     *
     * @param StoreRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->all();

        $role = $this->roles->createRole($data);

        event(new RoleCreated($role));

        Alert::success(trans('admin.roles.elements.Role created successfully'));

        return redirect()->route('admin.roles.edit', $role);
    }

    /**
     * Show Role edit form
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $this->authorize('adminRolesEdit', $role);

        $form = FormBuilder::create(RoleForm::class, [
            'method' => 'PUT',
            'url' => route('admin.roles.update', $role),
            'model' => $role,
            'data' => [
                //
            ]
        ]);

        return view('admin.roles.form', compact('form', 'role'));
    }

    /**
     * Update a Role item
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->all();

        $role = $this->roles->updateRole($role, $data);

        event(new RoleUpdated($role));

        Alert::success(trans('admin.roles.elements.Role updated successfully'));

        return redirect()->route('admin.roles.edit', $role);
    }
}
