<?php

namespace App\Rules\Jalali;

use Exception;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Validation\Rule;

class JalaliDate implements Rule
{
    protected $format;

    /**
     * Create a new rule instance.
     *
     * @param $format
     * @return void
     */
    public function __construct($format = "Y-m-d H:i:s")
    {
        $this->format = $format;
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
        try{
            Verta::parseFormat($this->format, $value);

            return true;
        }catch (Exception $e){
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
        return trans('validation.jalali-date');
    }
}
