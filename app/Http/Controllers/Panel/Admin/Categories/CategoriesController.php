<?php

namespace App\Http\Controllers\Panel\Admin\Categories;

use App\Http\Controllers\Panel\Admin\AdminBaseController;
use App\Models\Categories\Category;
use App\Repositories\Categories\CategoryRepository;
use Illuminate\Http\Request;

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

        $categories = $this->categories->query()
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('panel.admin.categories.index', compact('categories'));
    }
}
