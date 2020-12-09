<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesquisaSatifacao extends Model
{
    protected $table = 'pesquisa_satisfacao';

    protected $fillable = ['ocorrencia_id', 'pergunta_id', 'resposta_id'];

    protected $with = ['pergunta'];

    public function pergunta()
    {
        return $this->hasOne(PerguntasPesquisa::class, 'id', 'pergunta_id');
    }
}
