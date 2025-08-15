<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\RequestInterface;
use Anik\Form\FormRequest as FormRquest;

class PageUpdateRequest extends FormRquest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'title' => 'string|min:5|max:100|unique:pages,title',
            'route' => 'string|min:5|max:100',
            'name'  => 'string|min:5|max:100',
            'user_id' => 'integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'Já existe uma página com esse title.',
            'route.unique' => 'Já existe uma página com esse route.',
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
