<?php

namespace App\Modules\Admin\Users\Controllers;


use App\Events\Users\UserCreated;
use App\Events\Users\UserUpdated;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Users\User;
use App\Modules\Admin\Users\Forms\UserForm;
use App\Modules\Admin\Users\Requests\StoreUserRequest;
use App\Modules\Admin\Users\Requests\UpdateUserRequest;
use App\Repositories\Users\UserRepository;
use App\Services\Alert\Facade\Alert;
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

        return view('admin.users.index');
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

        return view('admin.users.form', compact('form'));
    }

    /**
     * Store new User
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();

        $user = $this->users->createUser($data);

        event(new UserCreated($user));

        Alert::success(trans('admin.users.elements.User created successfully'));

        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Show User edit form
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('adminUsersEdit', $user);

        $form = FormBuilder::create(UserForm::class, [
            'method' => 'PUT',
            'url' => route('admin.users.update', $user),
            'model' => $user,
            'data' => [
                //
            ]
        ]);

        return view('admin.users.form', compact('form', 'user'));
    }

    /**
     * Update a User item
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();

        $user = $this->users->updateUser($user, $data);

        event(new UserUpdated($user));

        Alert::success(trans('admin.users.elements.User updated successfully'));

        return redirect()->route('admin.users.edit', $user);
    }
}
