<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaOuvidoria extends Model
{
    protected $table = 'ouvidoria_categoria';

    protected $hidden = ['created_at', 'updated_at'];
}
