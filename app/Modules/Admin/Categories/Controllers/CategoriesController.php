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

        $category = $this->categories->createCategory($data, $request->input('type'));

        Alert::success(trans('admin.categories.elements.Category created successfully'));

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Show Category edit form
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $this->authorize('adminCategoriesEdit', $category);

        $type = $category->type;

        $form = FormBuilder::create(CategoryForm::class, [
            'method' => 'PUT',
            'url' => route('admin.categories.update', $category),
            'model' => $category,
            'data' => [
                'type' => $type,
            ]
        ]);

        return view('admin.categories.form', compact('form', 'category'));
    }

    /**
     * Update a category item
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->all();

        $category = $this->categories->updateCategory($category, $data);

        Alert::success(trans('admin.categories.elements.Category updated successfully'));

        return redirect()->route('admin.categories.edit', $category);
    }
}
