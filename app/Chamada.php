<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    protected $table = 'chamada_eletronica';

    protected $fillable = [
        'turma_id', 'data_chamada', 'alunos_presentes'
    ];
}
