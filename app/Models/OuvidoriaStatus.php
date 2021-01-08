<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OuvidoriaStatus extends Model
{
    public const STATUS_ABERTO = 1;
    public const STATUS_ENCAMINHADO = 2;
    public const STATUS_RESPONDIDO = 3;
    public const STATUS_CONCLUIDO = 4;
    public const STATUS_ENCAMINHADO_OUVIDORIA = 5;

    protected $table = 'ouvidorias_status';

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at'];

}
