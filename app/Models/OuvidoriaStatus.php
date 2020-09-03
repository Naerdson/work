<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OuvidoriaStatus extends Model
{
    public const STATUS_ABERTO = 1;
    public CONST STATUS_ENCAMINHADO = 2;
    public const STATUS_RESPONDIDO_POR_EMAIL = 3;
    public const STATUS_CONCLUIDO = 4;

    protected $table = 'ouvidorias_status';
    protected $hidden = ['created_at', 'updated_at'];
    protected $visible = ['nome'];
}
