<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','permissao','url_foto','rua','numero','cep','cidade','telefone',
        'celular','rg','cpf','data_nasc','genero','nome_mae','mae_email','mae_RG','mae_CPF',
        'mae_titulo_eleitoral','mae_data_nasc','nome_pai','pai_email','pai_RG','pai_CPF','pai_titulo_eleitoral',
        'pai_data_de_nasc','situacao_civil_dos_pais','autorizacao_de_buscar_na_escola','deficiencia',
        'grupo_sanguineo','mao_boa','cor_raça','estado_civil','nome_do_conjuge','nome_dos_filhos'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
