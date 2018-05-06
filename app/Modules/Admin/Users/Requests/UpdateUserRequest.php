<?php

namespace App\Modules\Admin\Users\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Users\User;
use App\Types\Blog\UserStatus;
use App\Types\State;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = User::query()->findOrFail($this->route('user'));

        return $this->user()->can('adminUsersEdit', $item);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user');

        return [
            'state' => [Rule::in(State::values()),],

            'title' => ['required', 'between:1, 255'],

            'excerpt' => ['nullable', 'between:1, 8190'],

            'content' => ['required', 'between:1, 819000'],

            'slug' => ['required', 'alpha_dash', 'unique:users,slug,' . $id, 'between:1, 255'],

            'category_id' => ['nullable', Rule::exists('categories', 'id')],

            'user_id' => ['required', Rule::exists('users', 'id')],

            'status' => ['required', Rule::in(UserStatus::values())],

            'published_at' => ['nullable'],

            'expired_at' => ['nullable'],

            'meta_keywords' => ['nullable', 'array'],

            'meta_description' => ['nullable', 'between:0,8190'],

            'image_path' => ['nullable'],
        ];
    }
}