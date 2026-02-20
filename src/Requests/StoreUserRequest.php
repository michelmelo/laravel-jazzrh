<?php

namespace MichelMelo\JazzRh\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'cpf' => ['nullable', 'string', 'unique:users,cpf'],
            'role' => ['required', 'string', 'in:admin,manager,recruiter,user'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Informe um email válido',
            'email.unique' => 'Este email já está cadastrado',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres',
            'password.confirmed' => 'As senhas não conferem',
            'cpf.unique' => 'Este CPF já está cadastrado',
            'role.required' => 'O perfil é obrigatório',
            'role.in' => 'Perfil inválido',
        ];
    }
}
