<?php

namespace App\Modules\Admin\Posts\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Posts\Post;
use App\Repositories\Posts\PostRepository;
use App\Transformers\Posts\PostAdminTransformer;
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

        return DataTables::of($this->posts->getAdminDataTable())
            ->setTransformer(new PostAdminTransformer())
            ->make(true);
    }
}
