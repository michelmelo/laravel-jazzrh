<?php

namespace MichelMelo\JazzRh\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$this->route('user')],
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'unique:users,cpf,'.$this->route('user')],
            'role' => ['required', 'string', 'in:admin,manager,recruiter,user'],
        ];
    }
}
