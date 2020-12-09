<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObservacaoPesquisaSatisfacao extends Model
{
    protected $table = 'observacao_pesquisas_satisfacao';

    protected $fillable = [
        'ocorrencia_id',
        'descricao'
    ];
}
