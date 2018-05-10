<?php

namespace App\Modules\Admin\Users\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Users\User;
use App\Modules\Admin\Users\Forms\UserForm;
use App\Modules\Admin\Users\Requests\StoreUserRequest;
use App\Modules\Admin\Users\Requests\UpdateUserRequest;
use App\Repositories\Users\UserRepository;
use App\Services\Alert\Facade\Alert;
use Exception;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class UsersController extends AdminBaseController
{
    protected $users;

    /**
     * Crate Users Controller Instance
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('adminUsersIndex', User::class);

        return view('AdminUsers::index');
    }

    /**
     * Show User creation form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('adminUsersCreate', User::class);

        $form = FormBuilder::create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.store'),
            'data' => [
                //
            ]
        ]);

        return view('AdminUsers::form', compact('form'));
    }

    /**
     * Store new User
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->all();

            $item = $this->users->createUser($data);

        } catch (Exception $e) {
            Alert::error(trans('admin.users.elements.Creating user failed'));

            return back()->withInput();
        }

        Alert::success(trans('admin.users.elements.User created successfully'));

        return redirect()->route('admin.users.edit', $item);
    }

    /**
     * Show User edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->users->findOrFail($id);

        $this->authorize('adminUsersEdit', $item);

        $form = FormBuilder::create(UserForm::class, [
            'method' => 'PUT',
            'url' => route('admin.users.update', $item),
            'model' => $item,
            'data' => [
                //
            ]
        ]);

        return view('AdminUsers::form', compact('form', 'item'));
    }

    /**
     * Update a User item
     *
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $item = $this->users->findOrFail($id);

            $data = $request->all();

            $item = $this->users->updateUser($item, $data);

        } catch (Exception $e) {
            Alert::error(trans('admin.users.elements.Updating user failed'));

            return back()->withInput();
        }

        Alert::success(trans('admin.users.elements.User updated successfully'));

        return redirect()->route('admin.users.edit', $item);
    }
}
