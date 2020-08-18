<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OuvidoriaStatus extends Model
{
    protected $table = 'ouvidorias_status';
    protected $hidden = ['created_at', 'updated_at'];
    protected $visible = ['nome'];
}
