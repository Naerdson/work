<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusOuvidoria extends Model
{
    protected $table = 'ouvidoria_status';

    protected $hidden = ['created_at', 'updated_at'];
}
