<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

class OuvidoriaHistorico extends Model
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

    protected $hidden = [
        'status_ocorrencia_id',
        'setor_id',
        'user_id',
        'created_at',
        'updated_at',
        'ocorrencia_id',
    ];

    protected $appends = [
        'data_criacao'
    ];

    public function getDataCriacaoAttribute()
    {
        return strftime('%d de %B de %Y', strtotime($this->attributes['created_at']));
    }

    public function listAllOccurrencesWithCondition($sector)
    {
        return DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_historico as historico', 'ocorrencia.id', '=', 'historico.ocorrencia_id')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->where('historico.setor_id', $sector)
            ->select('ocorrencia.id','ocorrencia.protocolo' ,'categoria.nome as categoria', 'status.nome as status', 'ocorrencia.created_at as data')
            ->get();

    }

    public function getHistoric($id)
    {
        return DB::table('ouvidoria_historico as historico')
            ->join('ouvidoria_status as status', 'status.id', '=', 'historico.status_ocorrencia_id')
            ->join('setor', 'setor.id', '=', 'historico.setor_id')
            ->join('usuario', 'usuario.id', '=', 'historico.user_id')
            ->where('historico.ocorrencia_id', $id)
            ->select('historico.ocorrencia_id', 'status.nome as status', 'setor.nome as setor', 'usuario.nome as usuario', 'historico.created_at as criado_em')
            ->get();
    }

    public function ouvidoria()
    {
        return $this->belongsTo(Ouvidoria::class, 'id', 'ocorrencia_id');
    }

    public function status()
    {
        return $this->hasOne(StatusOuvidoria::class, 'id', 'status_ocorrencia_id');
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
