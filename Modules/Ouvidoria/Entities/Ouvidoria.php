<?php

namespace Modules\Ouvidoria\Entities;

use Illuminate\Database\Eloquent\Model;

class Ouvidoria extends Model
{
    protected $table = 'ocorrencia';
    protected $fillable = [
        'nome', 'protocolo', 'contato', 'descricao', 'categoria_id', 'demandante_id', 'campus_id'
    ];
}
