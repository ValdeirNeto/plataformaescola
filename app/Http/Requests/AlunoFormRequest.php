<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoFormRequest extends FormRequest
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
            'data_nascimento' => 'required',
            'email' => 'required',
            'ra' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio'
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'NOME',
            'data_nascimento' => 'DATA DE NASCIMENTO',
            'email' => 'EMAIL',
            'ra' => 'RA'
        ];
    }
}
