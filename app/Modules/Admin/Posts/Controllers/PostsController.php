<?php

namespace App\Modules\Admin\Posts\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Posts\Post;
use App\Modules\Admin\Posts\Forms\PostForm;
use App\Modules\Admin\Posts\Requests\StorePostRequest;
use App\Modules\Admin\Posts\Requests\UpdatePostRequest;
use App\Repositories\Posts\PostRepository;
use App\Services\Alert\Facade\Alert;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class PostsController extends AdminBaseController
{
    protected $posts;

    /**
     * Crate Posts Controller Instance
     *
     * @param PostRepository $posts
     */
    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Show index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('adminPostsIndex', Post::class);

        return view('admin.posts.index');
    }

    /**
     * Show Post creation form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('adminPostsCreate', Post::class);

        $form = FormBuilder::create(PostForm::class, [
            'method' => 'POST',
            'url' => route('admin.posts.store'),
            'data' => [
                //
            ]
        ]);

        return view('admin.posts.form', compact('form'));
    }

    /**
     * Store new Post
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all();

        $post = $this->posts->createPost($data);

        Alert::success(trans('admin.posts.elements.Post created successfully'));

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Show Category edit form
     *
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $this->authorize('adminPostsEdit', $post);

        $form = FormBuilder::create(PostForm::class, [
            'method' => 'PUT',
            'url' => route('admin.posts.update', $post),
            'model' => $post,
            'data' => [
                //
            ]
        ]);

        return view('admin.posts.form', compact('form', 'post'));
    }

    /**
     * Update a Post item
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();

        $post = $this->posts->updatePost($post, $data);

        Alert::success(trans('admin.posts.elements.Post updated successfully'));

        return redirect()->route('admin.posts.edit', $post);
    }
}
