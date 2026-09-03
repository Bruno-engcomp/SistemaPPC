<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropostaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'unidade_id' => 'required|exists:unidades,id',
            'nome_curso' => 'required|string|max:255',
            'modalidade' => 'required|string|in:Presencial,EAD,Híbrido',
            'carga_horaria_total' => 'required|integer|min:100',
            'justificativa' => 'required|string',
            'perfil_egresso' => 'required|string',
            'disciplinas' => 'required|array|min:1',
            'disciplinas.*.nome' => 'required|string|max:255',
            'disciplinas.*.carga_horaria' => 'required|integer|min:10',
            'disciplinas.*.periodo' => 'required|integer|min:1',
            'disciplinas.*.ementa' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nome_curso.required' => 'O nome do curso é obrigatório.',
            'carga_horaria_total.min' => 'A carga horária total mínima é de 100 horas.',
            'disciplinas.min' => 'É necessário cadastrar pelo menos uma disciplina na proposta.',
        ];
    }
}
