<?php

namespace App\Modules\Admin\Roles\Requests;


use App\Http\Requests\Admin\AdminBaseRequest;
use App\Models\Roles\Role;
use App\Types\State;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends AdminBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Role::query()->findOrFail($this->route('role'));

        return $this->user()->can('adminRolesEdit', $item);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('role');

        return [
            'state' => [Rule::in(State::values()),],

            'name' => ['required', 'unique:roles,name,' . $id, 'between:1, 255'],

            'title' => ['required', 'between:1, 255'],

            'description' => ['nullable', 'between:1, 8190'],
        ];
    }
}