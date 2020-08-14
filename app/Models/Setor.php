<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setor';

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at'];

    public function setor_responsavel_ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'setor_responsavel_id', 'id');
    }

}
