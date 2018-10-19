<?php

namespace App\Modules\Accounts\Auth\Controllers;

use App\Http\Controllers\Accounts\AccountsBaseController;
use App\Models\Users\User;
use App\Modules\Accounts\Auth\Requests\RegisterUserRequest;
use App\Repositories\Users\UserRepository;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends AccountsBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RedirectsUsers;

    /**
     * Users repository
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest');

        $this->users = $users;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        $this->guard()->login(
            $this->create($request->all())
        );

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->users->registerUser($data);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Redirect  after registration completed
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('site.index');
    }
}
