<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = 'comunicado';

    protected $fillable = [
        'de','para','mensagem', 'data_cadastro', 'data_validade'
    ];
}
