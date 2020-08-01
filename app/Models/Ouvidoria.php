<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ouvidoria extends Model
{
    protected $table = 'ouvidoria_ocorrencia';

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
        'data2',
        'categoria',
        'demandante',
        'status',
        'campus',
        'setor_responsavel'
    ];


    public function getData2Attribute()
    {
        return date('d/m/Y', strtotime($this->attributes['created_at']));
    }

    public function getCategoriaAttribute()
    {
        return $this->categoria()->first()->nome;
    }

    public function getDemandanteAttribute()
    {
        return $this->demandante()->first()->nome;
    }

    public function getStatusAttribute()
    {
        return $this->status()->first()->nome;
    }

    public function getCampusAttribute()
    {
        return $this->campus()->first()->nome;
    }

    public function getSetorResponsavelAttribute()
    {
        return $this->setorResponsavel()->first()->nome;
    }

    public function listAllOccurrences()
    {

        return DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_demandante as demandante', 'demandante.id', '=', 'ocorrencia.demandante_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('campus', 'campus.id', '=', 'ocorrencia.campus_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->orderBy('ocorrencia.created_at', 'desc')
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

    public function getOuvidoriaWhereProtocol($protocolo)
    {
        return DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->where('ocorrencia.protocolo', '=', $protocolo)
            ->select('ocorrencia.id','ocorrencia.protocolo','ocorrencia.contato as email','categoria.nome as categoria', 'status.nome as status','ocorrencia.created_at as data', 'setor.nome as setor_responsavel')
            ->first();
    }

    public function getCountOuvidoria()
    {
        return [
            'total' => DB::table('ouvidoria_ocorrencia')->count(),
            'encaminhado' => DB::table('ouvidoria_ocorrencia')->where('status_id', '2')->count(),
            'concluido' => DB::table('ouvidoria_ocorrencia')->where('status_id', '4')->count(),
            'aberto' => DB::table('ouvidoria_ocorrencia')->where('status_id', '1')->count(),
        ];
    }

    public function historic()
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
