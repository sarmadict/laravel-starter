<?php

namespace App\Modules\Admin\Posts\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Posts\Post;
use App\Modules\Admin\Posts\Forms\PostForm;
use App\Modules\Admin\Posts\Requests\StorePostRequest;
use App\Modules\Admin\Posts\Requests\UpdatePostRequest;
use App\Repositories\Posts\PostRepository;
use App\Services\Alert\Facade\Alert;
use Exception;
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

        return view('AdminPosts::index');
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

        return view('AdminPosts::form', compact('form'));
    }

    /**
     * Store new Post
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        try {
            $data = $request->all();

            $item = $this->posts->createPost($data);

        } catch (Exception $e) {
            Alert::error(trans('admin.posts.elements.Creating post failed'));

            return back()->withInput();
        }

        Alert::success(trans('admin.posts.elements.Post created successfully'));

        return redirect()->route('admin.posts.edit', $item);
    }

    /**
     * Show Category edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->posts->findOrFail($id);

        $this->authorize('adminPostsEdit', $item);

        $form = FormBuilder::create(PostForm::class, [
            'method' => 'PUT',
            'url' => route('admin.posts.update', $item),
            'model' => $item,
            'data' => [
                //
            ]
        ]);

        return view('AdminPosts::form', compact('form', 'item'));
    }

    /**
     * Update a category item
     *
     * @param UpdatePostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $item = $this->posts->findOrFail($id);

            $data = $request->all();

            $item = $this->posts->updatePost($item, $data);

        } catch (Exception $e) {
            Alert::error(trans('admin.posts.elements.Updating post failed'));

            return back()->withInput();
        }

        Alert::success(trans('admin.posts.elements.Post updated successfully'));

        return redirect()->route('admin.posts.edit', $item);
    }
}
