<?php

namespace App\Http\Requests\Email;

use App\Http\Requests\RequestInterface;
use Anik\Form\FormRequest as FormRequest;

class EmailUpdateRequest extends FormRequest implements RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Você pode adicionar uma lógica para verificar se o usuário autenticado
        // pode enviar um e-mail em nome do 'user_id' fornecido.
        // Por enquanto, vamos permitir.
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
            'recipient_email' => 'email|max:255',
            'subject' => 'string|max:255',
            'body' => 'string',
            // Garante que o user_id seja um inteiro e exista na tabela 'users'
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'recipient_email.required' => 'O e-mail do destinatário é obrigatório.',
            'recipient_email.email' => 'Forneça um endereço de e-mail válido.',
            'subject.required' => 'O assunto é obrigatório.',
            'body.required' => 'O corpo do e-mail não pode estar vazio.',
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
