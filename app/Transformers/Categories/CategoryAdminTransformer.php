<?php

namespace App\Transformers\Categories;


use App\Models\Categories\Category;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class CategoryAdminTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        $auth = Auth::user();

        return [
            'id' => (int)$category->id,
            'name' => $category->name,
            'title' => $category->title,
            'slug' => $category->slug,
            'hits' => $category->hits,
            'parent_title' => $category->parent_title,
            'type_name' => $category->type_name,
            'state_name' => $category->state_name,
            'actions' => $this->getActions($auth, $category),
        ];
    }

    public function getActions($auth, $item)
    {
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
    }
}