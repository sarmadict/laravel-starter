<?php

namespace App\Modules\Admin\Posts\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Posts\Post;
use App\Repositories\Posts\PostRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostsTableController extends AdminBaseController
{
    protected $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function __invoke(Request $request)
    {
        $this->authorize('adminPostsIndex', Post::class);

        $auth = $request->user();

        return DataTables::of($this->posts->getAdminDataTable())
            ->removeColumn('state')
            ->removeColumn('user_id')
            ->removeColumn('user')
            ->removeColumn('category_id')
            ->removeColumn('category')
            ->removeColumn('status')
            ->addColumn('j_published_at', function ($item) {
                return $item->j_published_at;
            })
            ->addColumn('j_expired_at', function ($item) {
                return $item->j_expired_at;
            })
            ->addColumn('state_name', function ($item) {
                return $item->state_name;
            })
            ->addColumn('status_name', function ($item) {
                return $item->status_name;
            })
            ->addColumn('category_title', function ($item) {
                return $item->category_title;
            })
            ->addColumn('actions', function ($item) use ($auth) {
                $actions = "";

                if ($auth->can('adminPostsShow', $item)) {
                    $actions .= '<a href="' . route('admin.posts.show', $item) . '" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.show') . '">'
                        . '<i class="fa fa-eye"></i> ' . trans('admin.default.actions.show')
                        . '</a>';
                }

                if ($auth->can('adminPostsEdit', $item)) {
                    $actions .= '<a href="' . route('admin.posts.edit', $item) . '" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.edit') . '">'
                        . '<i class="fa fa-pencil"></i> ' . trans('admin.default.actions.edit')
                        . '</a>';
                }

                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
