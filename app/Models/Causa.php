<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Causa extends Model
{
    public CONST ATENDIMENTO = 2;
    public const INFRAESTRUTURA = 3;
    public const MANUTENCAOELIMPEZA = 4;
    public const SEGURANCA = 5;
    public const COBRANCAFINANCEIRA = 6;
    public const MENSALIDAE = 7;
    public const NOTASEFREQUENCIA = 8;
    public const SERVICOSEEQUIPAMENTODEINFORMATICA = 9;
    public const TELEFONIA = 10;
    public const CUMPRIMENTODEPRAZOS = 11;
    public const OUTROS = 12;

    protected $table = 'causas';

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at'];
}
