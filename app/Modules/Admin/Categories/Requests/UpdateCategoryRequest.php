<?php

namespace App\Modules\Admin\Categories\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Categories\Category;
use App\Types\General\Category as CategoryType;
use App\Types\State;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Category::query()->findOrFail($this->route('category'));

        return $this->user()->can('adminCategoriesEdit', $item);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('category');

        return [
            'state' => [
                Rule::in(State::values()),
            ],

            'name' => ['required', 'unique:categories,name,' . $id, 'between:1, 255'],

            'title' => ['required', 'between:1, 255'],

            'description' => ['nullable', 'between:1, 255000'],

            'slug' => ['nullable', 'alpha_dash', 'unique:categories,slug,' . $id, 'between:1, 255'],

            'parent_id' => [
                Rule::exists('categories', 'id')->whereNot('id', $id),
            ],

            'keywords' => [],
        ];
    }
}