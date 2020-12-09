<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    public CONST ATENDIMENTO = 1;
    public const INFRAESTRUTURA = 2;
    public const MENUTENÇAOELIMPEZA = 3;
    public const SEGURANCA = 4;
    public const COBRANCAFINANCEIRA = 5;
    public const MENSALIDADE = 6;
    public const NOTASEFREQUENCIA = 7;
    public const SERVICOSEEQUIPAMENTOSDEINFORMATICA = 8;
    public const TELEFONIA = 9;
    public const CUMPRIMENTODEPRAZOS = 10;
    public const OUTROS = 11;

    protected $table = 'causa';
    protected $hidden = ['created_at', 'updated_at'];
}
