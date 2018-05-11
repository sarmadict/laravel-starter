<?php

namespace App\Modules\Admin\Categories\Controllers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Categories\Category;
use App\Repositories\Categories\CategoryRepository;
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

        $auth = $request->user();

        return DataTables::of($this->categories->getAdminDataTable())
            ->removeColumn('state')
            ->removeColumn('parent')
            ->removeColumn('type')
            ->addColumn('parent_title', function ($item) {
                return $item->parent_title;
            })
            ->addColumn('type_name', function ($item) {
                return $item->type_name;
            })
            ->addColumn('state_name', function ($item) {
                return $item->state_name;
            })
            ->addColumn('actions', function ($item) use ($auth) {
                $actions = "";

                if ($auth->can('adminCategoriesShow', $item)) {
                    $actions .= '<a href="' . route('admin.categories.show', $item) . '" class="btn btn-block btn-xs btn-light-azure" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.show') . '">'
                        . '<i class="fa fa-eye"></i> ' . trans('admin.default.actions.show')
                        . '</a>';
                }

                if ($auth->can('adminCategoriesEdit', $item)) {
                    $actions .= '<a href="' . route('admin.categories.edit', $item) . '" class="btn btn-block btn-xs btn-dark-purple" data-toggle="tooltip" data-placement="left" title="' . trans('admin.default.actions.edit') . '">'
                        . '<i class="fa fa-pencil"></i> ' . trans('admin.default.actions.edit')
                        . '</a>';
                }

                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
