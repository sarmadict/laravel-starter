<?php

namespace App\Modules\Admin\Roles\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Roles\Role;
use App\Types\Blog\RoleStatus;
use App\Types\State;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('adminRolesCreate', Role::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'state' => [Rule::in(State::values()),],

            'name' => ['required', 'unique:roles,name', 'between:1, 255'],

            'title' => ['required', 'between:1, 255'],

            'description' => ['nullable', 'between:1, 8190'],
        ];
    }
}