<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaFormRequest extends FormRequest
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
            'descricao' => 'required',
            'horario' => 'required',
            'professor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
        ];
    }

    public function attributes()
    {
        return [
            'descricao' => 'DESCRIÇÃO',
            'horario' => 'PERIODO',
            'professor' => 'PROFESSOR'
        ];
    }
}
