<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao'];

    public function respostas()
    {
        return $this->hasMany(Resposta::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }
}
