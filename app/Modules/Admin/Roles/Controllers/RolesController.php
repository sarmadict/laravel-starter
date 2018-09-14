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

        return view('AdminRoles::index');
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

        return view('AdminRoles::form', compact('form'));
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

        $item = $this->roles->createRole($data);

        event(new RoleCreated($item));

        Alert::success(trans('admin.roles.elements.Role created successfully'));

        return redirect()->route('admin.roles.edit', $item);
    }

    /**
     * Show Category edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->roles->findOrFail($id);

        $this->authorize('adminRolesEdit', $item);

        $form = FormBuilder::create(RoleForm::class, [
            'method' => 'PUT',
            'url' => route('admin.roles.update', $item),
            'model' => $item,
            'data' => [
                //
            ]
        ]);

        return view('AdminRoles::form', compact('form', 'item'));
    }

    /**
     * Update a category item
     *
     * @param UpdateRoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $item = $this->roles->findOrFail($id);

        $data = $request->all();

        $item = $this->roles->updateRole($item, $data);

        event(new RoleUpdated($item));

        Alert::success(trans('admin.roles.elements.Role updated successfully'));

        return redirect()->route('admin.roles.edit', $item);
    }
}
