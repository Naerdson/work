<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setores';

    protected $fillable = ['nome'];

    protected $hidden = ['created_at', 'updated_at'];
    protected $visible = ['nome'];

    public function setor_responsavel_ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'setor_responsavel_id', 'id');
    }

}
