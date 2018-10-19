<?php

namespace App\Modules\Admin\Categories\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Categories\Category;
use App\Modules\Admin\Categories\Forms\CategoryForm;
use App\Modules\Admin\Categories\Requests\StoreCategoryRequest;
use App\Modules\Admin\Categories\Requests\UpdateCategoryRequest;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Alert\Facade\Alert;
use App\Types\General\Category as CategoryType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class CategoriesController extends AdminBaseController
{
    protected $categories;

    /**
     * Crate Categories Controller Instance
     *
     * @param CategoryRepository $categories
     */
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Show index page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('adminCategoriesIndex', Category::class);

        return view('admin.categories.index');
    }

    /**
     * Show Category creation form
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('adminCategoriesCreate', Category::class);

        $this->validate($request, [
            'type' => [
                'required',
                Rule::in(CategoryType::values()),
            ],
        ]);

        $type = $request->input('type');

        $form = FormBuilder::create(CategoryForm::class, [
            'method' => 'POST',
            'url' => route('admin.categories.store'),
            'data' => [
                'type' => $type,
            ]
        ]);

        return view('admin.categories.form', compact('form', 'type'));
    }

    /**
     * Store new Category
     *
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();

        $item = $this->categories->createCategory($data, $request->input('type'));

        Alert::success(trans('admin.categories.elements.Category created successfully'));

        return redirect()->route('admin.categories.edit', $item);
    }

    /**
     * Show Category edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->categories->findOrFail($id);

        $this->authorize('adminCategoriesEdit', $item);

        $type = $item->type;

        $form = FormBuilder::create(CategoryForm::class, [
            'method' => 'PUT',
            'url' => route('admin.categories.update', $item),
            'model' => $item,
            'data' => [
                'type' => $type,
            ]
        ]);

        return view('admin.categories.form', compact('form', 'item'));
    }

    /**
     * Update a category item
     *
     * @param UpdateCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $item = $this->categories->findOrFail($id);

        $data = $request->all();

        $item = $this->categories->updateCategory($item, $data);

        Alert::success(trans('admin.categories.elements.Category updated successfully'));

        return redirect()->route('admin.categories.edit', $item);
    }
}
