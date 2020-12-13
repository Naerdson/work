<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesquisaSatifacao extends Model
{
    protected $table = 'pesquisa_satisfacao';

    protected $fillable = ['ocorrencia_id', 'pergunta_id', 'resposta_id'];

    protected $with = ['pergunta', 'ocorrencia', 'resposta'];

    public function pergunta()
    {
        return $this->hasOne(PerguntasPesquisa::class, 'id', 'pergunta_id');
    }

    public function ocorrencia()
    {
        return $this->hasOne(OuvidoriasOcorrencia::class, 'id', 'ocorrencia_id');
    }

    public function resposta()
    {
        return $this->hasMany(OpcaoPesquisaSatisfacao::class, 'id', 'resposta_id');
    }
}
