<?php

namespace App\Modules\Accounts\Auth\Requests;

use App\Http\Requests\Accounts\AccountsBaseRequest;

class LoginRequest extends AccountsBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required'],
            'password' => ['required'],
        ];
    }
}
