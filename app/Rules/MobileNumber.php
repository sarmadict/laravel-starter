<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileNumber implements Rule
{
    protected $countryCode;

    /**
     * Create a new rule instance.
     *
     * @param $countryCode
     * @return void
     */
    public function __construct($countryCode = "98")
    {
        $this->countryCode = preg_replace('/[^0-9]/', '', $countryCode);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $regex = "/(0|\+{$this->countryCode})?([ ]|-|[()]){0,2}9[0-9]{1}([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/";

        return preg_match($regex, $value) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.mobile_number');
    }
}
