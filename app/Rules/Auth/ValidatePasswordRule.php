<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ValidatePasswordRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($authData)
    {
        $this->email = $authData['email'];
        $this->password = $authData['password'];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Auth::attempt([
            'email' => $this->email,
            'password' => $this->password
        ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Введён некорректный пароль';
    }
}
