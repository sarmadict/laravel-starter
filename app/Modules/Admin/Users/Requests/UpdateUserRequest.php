<?php

namespace App\Modules\Admin\Users\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Users\User;
use App\Rules\MobileNumber;
use App\Types\Accounts\Gender;
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

            'first_name' => ['required', 'max:255'],

            'last_name' => ['required', 'max:255'],

            'display_name' => ['nullable', 'max: 255'],

            'username' => ['required', 'unique:users,username,' . $id, 'alpha_dash'],

            'email' => ['required', 'email', 'unique:users,email,' . $id],

            'mobile_number' => ['nullable', new MobileNumber()],

            'position' => ['nullable', 'max:255'],

            'gender' => [Rule::in(Gender::values())],

            'image_path' => ['nullable', 'url'],

            'birthday' => ['nullable', 'date:Y-m-d'],
        ];
    }
}