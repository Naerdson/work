<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntasPesquisa extends Model
{
    protected $fillable = ['nome', 'status'];

    public function pesquisas()
    {
        return $this->hasMany(PesquisaSatifacao::class, 'pergunta_id', 'id');
    }
}
