<?php

namespace App\Modules\Admin\Categories\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
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
        return $this->user()->can('adminCategoriesEdit', $this->route('category'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $item = $this->route('category');

        return [
            'state' => [
                Rule::in(State::values()),
            ],

            'name' => ['required', 'unique:categories,name,' . $item->id, 'between:1, 255'],

            'title' => ['required', 'between:1, 255'],

            'description' => ['nullable', 'between:1, 255000'],

            'slug' => ['nullable', 'alpha_dash', 'unique:categories,slug,' . $item->id, 'between:1, 255'],

            'parent_id' => [
                Rule::exists('categories', 'id')->whereNot('id', $item->id),
            ],

            'keywords' => [],
        ];
    }
}