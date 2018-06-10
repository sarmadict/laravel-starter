<?php

namespace App\Modules\Admin\Categories\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Categories\Category;
use App\Repositories\Categories\CategoryRepository;
use App\Transformers\Categories\CategoryAdminTransformer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesTableController extends AdminBaseController
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function __invoke(Request $request)
    {
        $this->authorize('adminCategoriesIndex', Category::class);

        return DataTables::of($this->categories->getAdminDataTable())
            ->setTransformer(new CategoryAdminTransformer())
            ->make(true);
    }
}
