<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

class OuvidoriasHistorico extends Model
{
    protected $fillable = [
        'ocorrencia_id', 
        'status_ocorrencia_id', 
        'setor_id', 
        'user_id'
    ];

    protected $with = [
        'status',
        'setor',
        'usuario'
    ];

    protected $visible = ['data_criacao', 'status', 'setor', 'usuario'];

    protected $hidden = [
        'status_ocorrencia_id',
        'setor_id',
        'user_id',
        'created_at',
        'updated_at',
        'ocorrencia_id',
    ];

    protected $appends = ['data_criacao'];

    public function getDataCriacaoAttribute()
    {
        return strftime('%d de %B de %Y', strtotime($this->attributes['created_at']));
    }
    
    public function ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'id', 'ocorrencia_id');
    }

    public function status()
    {
        return $this->hasOne(OuvidoriaStatus::class, 'id', 'status_ocorrencia_id');
    }

    public function setor()
    {
        return $this->hasOne(Setor::class, 'id', 'setor_id');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
