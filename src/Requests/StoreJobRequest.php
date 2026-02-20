<?php

namespace MichelMelo\JazzRh\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'location' => ['required', 'string', 'max:255'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gt:salary_min'],
            'contract_type' => ['required', 'string', 'in:clt,pj,temporary,internship'],
            'seniority_level' => ['required', 'string', 'in:junior,mid-level,senior'],
            'status' => ['required', 'string', 'in:draft,published,closed'],
            'closes_at' => ['nullable', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título da vaga é obrigatório',
            'description.required' => 'A descrição é obrigatória',
            'category_id.required' => 'A categoria é obrigatória',
            'category_id.exists' => 'A categoria selecionada não existe',
            'location.required' => 'A localização é obrigatória',
            'salary_max.gt' => 'O salário máximo deve ser maior que o mínimo',
            'closes_at.after' => 'A data de fechamento deve ser no futuro',
        ];
    }
}
