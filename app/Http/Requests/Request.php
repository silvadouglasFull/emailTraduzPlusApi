<?php

namespace App\Http\Requests;

use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Validation\ValidationException;

abstract class Request extends IlluminateRequest
{
    /**
     * A new validator instance for the request.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Altere para sua lógica de autorização
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        if (false === $this->authorize()) {
            abort(403, 'This action is unauthorized.');
        }

        $this->validator = app(ValidationFactory::class)->make(
            $this->all(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );

        if ($this->validator->fails()) {
            throw new ValidationException($this->validator);
        }
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated(): array
    {
        if ($this->validator) {
            return $this->validator->validated();
        }
        return [];
    }
}
