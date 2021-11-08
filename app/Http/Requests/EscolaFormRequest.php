<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EscolaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'cnpj' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'unique' => 'Já existe um usuário com esse :attribute cadastrado no sistema, verifique!'
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'NOME',
            'cnpj' => 'CNPJ'
        ];
    }
}
