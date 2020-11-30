<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaDemandante extends Model
{
    protected $table = 'ouvidoria_demandante';

    protected $hidden = ['created_at', 'updated_at'];
}
