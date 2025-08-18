<?php

namespace App\Http\Requests\RoleUser;

use App\Http\Requests\RequestInterface;
use Anik\Form\FormRequest as FormRquest;

class RoleUserStoreRequest extends FormRquest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => 'required|string|min:5|max:250|unique:role_users,role',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'A descrição da regra é obrigatório',
            'role.unique' => 'Já existe uma página com essa descrição de regra.',
            'user_id.exists' => 'O usuário fornecido não existe.',
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
