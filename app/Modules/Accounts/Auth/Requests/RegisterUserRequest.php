<?php

namespace App\Modules\Accounts\Auth\Requests;

use App\Http\Requests\Admin\AdminBaseRequest;
use App\Rules\Jalali\JalaliBefore;
use App\Rules\MobileNumber;
use App\Types\Accounts\Gender;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends AdminBaseRequest
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
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'alpha_dash', 'unique:users,username'],
            // 'mobile_number' => [
            //     'required', 'unique:users,mobile_number', new MobileNumber('98'),
            // ],
            'password' => ['required', 'min:2', 'max:50', 'confirmed'],
            // 'birth_year' => ['required', 'numeric', 'between:1200,' . verta()->year],
            // 'birth_month' => ['required', 'numeric', 'between:1,12'],
            // 'birth_day' => ['required', 'numeric', 'between:1,31'],
            'gender' => ['required', Rule::in(Gender::values())],
            'terms' => ['accepted'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Validate birth date
//        $validator->after(function ($validator) {
//            $rule = new JalaliBefore(verta());
//
//            $birthDate = Verta::createJalaliDate($this->input('birth_year'), $this->input('birth_month'), $this->input('birth_day'));
//
//            if (!$rule->passes('birth_date', $birthDate)) {
//                $validator->errors()->add('birth_date', $rule->message());
//            }
//        });
    }
}
