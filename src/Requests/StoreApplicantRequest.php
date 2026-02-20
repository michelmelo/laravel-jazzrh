<?php

namespace MichelMelo\JazzRh\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:applicants,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'unique:applicants,cpf'],
            'birth_date' => ['nullable', 'date', 'before:now'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:2'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'linkedin' => ['nullable', 'url'],
            'portfolio' => ['nullable', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.unique' => 'Este email já está cadastrado',
            'cpf.unique' => 'Este CPF já está cadastrado',
            'birth_date.before' => 'A data de nascimento deve estar no passado',
            'linkedin.url' => 'Informe uma URL válida para LinkedIn',
            'portfolio.url' => 'Informe uma URL válida para portfólio',
        ];
    }
}
