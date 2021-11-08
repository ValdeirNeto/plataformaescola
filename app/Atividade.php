<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    public $timestamps = false;
    protected $fillable = ['descricao', 'url_anexos'];

    public function perguntas(){
        return $this->hasMany(Pergunta::class);
    }
}
