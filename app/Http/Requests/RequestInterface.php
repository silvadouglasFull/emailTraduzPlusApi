<?php

namespace App\Http\Requests;

interface RequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array;

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array;
}
