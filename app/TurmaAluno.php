<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurmaAluno extends Model
{
    protected $table = 'turma_aluno';

    protected $fillable = [
        'aluno_id', 'turma_id'
    ];
}
