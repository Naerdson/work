<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OuvidoriasCategoria extends Model
{
    public const RECLAMACAO = 1;
    public CONST ELOGIO = 2;
    public const SUGESTAO = 3;
    public const INFORMACAO = 4;
    public const DENUNCIA = 5;

    protected $hidden = ['created_at', 'updated_at'];
}
