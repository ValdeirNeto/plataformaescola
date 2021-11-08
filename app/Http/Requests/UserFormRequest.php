<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'permissao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatorio',
            'min' => 'O campo :attribute precisa ter no minímo 8 caracteres',
            'unique' => 'Já existe um usuário com esse :attribute cadastrado no sistema, verifique!'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'SENHA',
            'name' => 'NOME',
            'email' => 'EMAIL',
            'permissao' => 'PERMISSÃO'
        ];
    }    
}
