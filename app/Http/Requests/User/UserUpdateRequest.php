<?php

namespace App\Http\Requests\User;

use App\Http\Requests\RequestInterface;
use Anik\Form\FormRequest as FormRquest;

class UserUpdateRequest extends FormRquest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:250|unique:users,name',
            'email' => 'required|string|email|min:3|max:250|unique:users,email',
            'password' => 'required|string|min:8|max:250|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.unique' => 'Já existe um usuário com esse nome.',
            'email.required' => 'O email é obrigatório',
            'email.unique' => 'Já existe um usuário com esse email.',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.confirmed' => 'A senha não confere com a confirmação.',
        ];
    }
    /**
     * Define os valores padrão para os atributos do DTO.
     *
     * @return array
     */
    public function defaults(): array
    {
        return [];
    }
}
