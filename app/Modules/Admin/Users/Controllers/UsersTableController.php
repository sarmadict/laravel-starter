<?php

namespace App\Modules\Admin\Users\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use App\Transformers\Users\UserAdminTransformer;
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

        return DataTables::of($this->users->getAdminDataTable())
            ->setTransformer(new UserAdminTransformer())
            ->make(true);
    }
}
