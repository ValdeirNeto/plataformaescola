<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtividadeRespondida extends Model
{
    public $timestamps = false;
    protected $fillable = ['resposta_dissertativa'];

    public function perguntas()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function atividade()
    {
        return $this->belongsTo(Atividade::class);
    }

    public function respostas()
    {
        return $this->belongsTo(Resposta::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
