<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao', 'alternativa', 'verdadeira'];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }
}
