<?php

namespace App\Modules\Admin\Categories\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Categories\Category;
use App\Modules\Admin\Categories\Forms\CategoryForm;
use App\Repositories\Categories\CategoryRepository;
use App\Types\General\Category as CategoryType;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Facades\FormBuilder;

class CategoriesController extends AdminBaseController
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function index(Request $request)
    {
        $this->authorize('adminCategoriesIndex', Category::class);

        $items = $this->categories->query()
            ->with('parent')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('AdminCategories::index', compact('items'));
    }

    public function create(Request $request)
    {
        $this->authorize('adminCategoriesCreate', Category::class);

        $this->validate($request, [
            'type' => [
                'required',
                'in:' . implode(',', CategoryType::values())
            ],
        ]);

        $form = FormBuilder::create(CategoryForm::class, [
            'method' => 'POST',
            'url' => route('admin.categories.store'),
            // 'class' => 'form-horizontal',
            'data' => [
                'type' => $request->input('type'),
            ]
        ]);

        return view('AdminCategories::form', compact('form'));
    }
}
