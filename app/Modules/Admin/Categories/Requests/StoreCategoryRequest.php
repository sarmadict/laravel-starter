<?php

namespace App\Modules\Admin\Categories\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Categories\Category;
use App\Types\General\Category as CategoryType;
use App\Types\State;

class StoreCategoryRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('adminCategoriesCreate', Category::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state' => ['in:' . implode(',', State::values())],
            'name' => ['required', 'unique:categories,name', 'between:1, 255'],
            'title' => ['required', 'between:1, 255'],
            'description' => ['nullable', 'between:1, 255000'],
            'slug' => ['nullable', 'alpha_dash', 'unique:categories,slug', 'between:1, 255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'keywords' => [],
            'type' => ['required', 'in:' . implode(',', CategoryType::values())],
        ];
    }
}