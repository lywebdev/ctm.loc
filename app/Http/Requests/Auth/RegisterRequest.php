<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'      => ['required'],
            'birthday'  => ['date_format:d.m.Y', 'nullable'],
            'birthtime' => ['date_format:H:i', 'nullable'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'confirmed', 'min:6'],
            'phone'     => ['nullable', 'string', 'min:5', 'max:15']
        ];
    }
}
