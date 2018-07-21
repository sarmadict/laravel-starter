<?php

namespace App\Modules\Admin\Core\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\Request;

class SearchUsersController extends AdminBaseController
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function search(Request $request)
    {
        $term = "%{$request->input('term', '')}%";

        $items = $this->users->simpleSearch($term)
            ->paginate($request->input('per_page', 50));

        return $items->setCollection(
            $items->getCollection()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => "{$item->display_name}($item->email)"
                ];
            })
        );
    }
}
