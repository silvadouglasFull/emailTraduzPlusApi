<?php

namespace App\Http\Requests\Page;

use App\Http\Requests\AbstractFormRequest as FormRequest;
use Illuminate\Validation\Rule;
use App\Http\Requests\RequestInterface;

class PageUpdateRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pageId = $this->route('id'); // Supondo que na rota está `page/{id}`

        return [
            'title' => [
                'string',
                'min:5',
                'max:100',
                Rule::unique('pages', 'title')->ignore($pageId),
            ],
            'route' => [
                'string',
                'min:5',
                'max:100',
                Rule::unique('pages', 'route')->ignore($pageId),
            ],
            'name'  => 'string|min:5|max:100',
            'user_id' => 'required|integer|exists:users,id',
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
}
