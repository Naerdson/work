<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OuvidoriasOcorrencia extends Model
{

    protected $fillable = [
        'nome', 
        'protocolo', 
        'contato', 
        'descricao', 
        'status_id', 
        'categoria_id', 
        'demandante_id', 
        'campus_id', 
        'setor_responsavel_id'
    ];

    protected $appends = [
        'data_criacao'
    ];

    protected $with = [
        'setorResponsavel',
        'categoria',
        'demandante',
        'status',
        'campus',
        'historicos'
    ];

    protected $hidden = [
        'categoria_id', 
        'demandante_id', 
        'status_id', 
        'campus_id', 
        'setor_responsavel_id',
        'created_at',
        'updated_at'
    ];

    public function getDataCriacaoAttribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));
    }

    public function listAllOccurrences($protocolo)
    {

        return DB::table('ouvidorias_ocorrencias as ocorrencia')
            ->join('ouvidorias_categorias as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidorias_demandantes as demandante', 'demandante.id', '=', 'ocorrencia.demandante_id')
            ->join('ouvidorias_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('campus', 'campus.id', '=', 'ocorrencia.campus_id')
            ->join('setores', 'setores.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->orderBy('ocorrencia.status_id', 'asc')
            ->where('ocorrencia.protocolo', 'LIKE' , '%' . $protocolo . '%')
            ->select('ocorrencia.id','ocorrencia.protocolo', 'ocorrencia.nome','ocorrencia.contato as email', 'ocorrencia.descricao','categoria.nome as categoria','demandante.nome as demandante', 'campus.nome as campus', 'status.nome as status', 'ocorrencia.status_id','ocorrencia.created_at as data', 'setor.nome as setor_responsavel', 'ocorrencia.setor_responsavel_id')
            ->paginate(5);
    }

    public function getAllOccurrencesWithSectorOuvidoria()
    {
        return DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_demandante as demandante', 'demandante.id', '=', 'ocorrencia.demandante_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('campus', 'campus.id', '=', 'ocorrencia.campus_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->orderBy('created_at', 'desc')
            ->select('ocorrencia.id','ocorrencia.protocolo', 'ocorrencia.nome','ocorrencia.contato as email', 'ocorrencia.descricao','categoria.nome as categoria','demandante.nome as demandante', 'campus.nome as campus', 'status.nome as status', 'ocorrencia.status_id','ocorrencia.created_at as data', 'setor.nome as setor_responsavel', 'ocorrencia.setor_responsavel_id')
            ->paginate(5);
    }

    public function getCountOuvidoria()
    {
        return [
            'total' => DB::table('ouvidorias_ocorrencias')->count(),
            'encaminhado' => DB::table('ouvidorias_ocorrencias')->where('status_id', '2')->count(),
            'concluido' => DB::table('ouvidorias_ocorrencias')->where('status_id', '4')->count(),
            'aberto' => DB::table('ouvidorias_ocorrencias')->where('status_id', '1')->count(),
        ];
    }

    public function historicos()
    {
        return $this->hasMany(HistoricoOuvidoria::class, 'ocorrencia_id', 'id');
    }

    public function setorResponsavel()
    {
        return $this->hasOne(Setor::class, 'id', 'setor_responsavel_id');
    }

    public function categoria()
    {
        return $this->hasOne(CategoriaOuvidoria::class, 'id', 'categoria_id');
    }

    public function demandante()
    {
        return $this->hasOne(CategoriaDemandante::class, 'id', 'demandante_id');
    }

    public function status()
    {
        return $this->hasOne(StatusOuvidoria::class, 'id', 'status_id');
    }

    public function campus()
    {
        return $this->hasOne(Campus::class, 'id', 'campus_id');
    }
}
