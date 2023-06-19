<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidSolapin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(substr($value, 0, 1) === "E" || substr($value, 0, 1) === "T"){
            if(Str::length($value) == 7){
                $sub = intval(substr($value, 1, 6));
                if(Str::length($sub) == 6 && is_numeric($sub)){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute debe empezar con E o T y contener 6 dígitos.';
    }
}
