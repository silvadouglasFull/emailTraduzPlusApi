<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use LPhilippo\CastableFormRequest\Http\Requests\Lumen\AbstractFormRequest as LumenAbstractFormRequest;

/**
 * Classe base para todos os Form Requests da API.
 * Herda da biblioteca e permite customizar o comportamento padrão,
 * como a resposta em caso de falha na validação.
 */
abstract class AbstractFormRequest extends LumenAbstractFormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
