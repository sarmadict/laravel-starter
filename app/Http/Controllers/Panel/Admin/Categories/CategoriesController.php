<?php

namespace App\Http\Controllers\Panel\Admin\Categories;

use App\Http\Controllers\Panel\Admin\AdminBaseController;
use App\Http\Forms\Panel\Admin\Categories\CategoryForm;
use App\Models\Categories\Category;
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
        $this->authorize('panelAdminCategoriesIndex', Category::class);

        $items = $this->categories->query()
            ->with('parent')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('panel.admin.categories.index', compact('items'));
    }

    public function create(Request $request)
    {
        $this->authorize('panelAdminCategoriesCreate', Category::class);

        $this->validate($request, [
            'type' => [
                'required',
                'in:' . implode(',', CategoryType::values())
            ],
        ]);

        $form = FormBuilder::create(CategoryForm::class, [
            'method' => 'POST',
            'url' => route('panel.admin.categories.store'),
            // 'class' => 'form-horizontal',
            'data' => [
                'type' => $request->input('type'),
            ]
        ]);

        return view('panel.admin.categories.form', compact('form'));
    }
}
