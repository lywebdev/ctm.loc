<?php

namespace App\Http\Requests\Auth;

use App\Rules\Auth\ValidatePasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LoginRequest extends FormRequest
{
    private $email;
    private $password;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        $this->email = $request->email;
        $this->password = $request->password;

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|exists:users',
            'password' => ['required', 'string', 'min:3', new ValidatePasswordRule([
                'email' => $this->email,
                'password' => $this->password,
            ])],
        ];
    }
}
