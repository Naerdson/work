<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{

    public CONST ADE = 2;
    public const ASA = 3;
    public const ATENDIMENTOALUNO = 4;
    public const ATENDIMENTOPSICOPEDAGOGICO = 5;
    public const BIBLIOTECA = 6;
    public const CALLCENTER = 7;
    public const CARREIRAS = 8;
    public const COOPEM = 9;
    public const CPA = 10;
    public const DIVISAOADM = 11;
    public const FIESPROUNI = 12;
    public const FINANCEIRO = 13;
    public const MARKETING = 14;
    public const NEAD = 15;
    public const NERS = 16;
    public const NEGOCIACAO = 17;
    public const NTI = 18;
    public const OUVIDORIA = 19;
    public const POSGRADUACAO = 20;
    public const QUEROSERALUNO = 21;
    public const RECEPCAO = 22;
    public const REITORIA = 23;
    public const RH = 24;
    public const SECRETARIACOORDENACAO = 25;
    public const TESOURARIA = 26;
    public const TUTORIA = 27;

    protected $table = 'setores';

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at'];

}
