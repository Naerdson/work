<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tratativa extends Model
{
    protected $table = 'tratativa';
    protected $filable = ['descricao'];
    protected $hidden = ['created_at', 'updated_at'];
}
