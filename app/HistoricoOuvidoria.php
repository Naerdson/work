<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoricoOuvidoria extends Model
{
    protected $table = 'ouvidoria_historico';

    protected $fillable = ['ocorrencia_id', 'status_ocorrencia', 'setor_id', 'user_id'];
}
