<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\AbstractFormRequest as FormRequest;
use App\Http\Requests\RequestInterface;

class PageStoreRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:100|unique:pages,title',
            'route' => 'required|string|min:5|max:100',
            'name'  => 'required|string|min:5|max:100',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O title é obrigatório',
            'title.unique'   => 'Já existe uma página com esse title.',
            'route.required' => 'O route é obrigatório',
            'name.required'  => 'O name é obrigatório',
            'user_id.exists' => 'O usuário fornecido não existe.',
        ];
    }
}
