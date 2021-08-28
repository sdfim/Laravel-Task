<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
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
        return preg_match('%^(?:\+380)[ -]?(\([0-9]{2}\)[ -]?[0-9]{3}[ -]?[0-9]{2}[ -]?[0-9]{2})$%i', $value) && strlen($value) >= 15;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Phone required format +380 (XX) XXX XX XX';
    }
}
