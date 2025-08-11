<?php

namespace App\Http\Requests;


class UserRequest implements UserRequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Validação de unicidade aqui
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' exige password_confirmation
        ];
    }
}
