<?php

namespace App\Rules\Jalali;

use Exception;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Validation\Rule;

class JalaliBefore implements Rule
{
    protected $jDate;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($jDate)
    {
        $this->jDate = ($jDate instanceof Verta) ? $jDate : Verta::parse($jDate);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $valueDate = Verta::parse($value);

            return $valueDate->lte($this->jDate);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.jalali-after');
    }
}
