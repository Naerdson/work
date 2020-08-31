<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OuvidoriasOcorrencia extends Model
{
    protected $table = 'ouvidorias_ocorrencias';

    protected $fillable = [
        'nome', 
        'protocolo', 
        'contato', 
        'descricao', 
        'status_id', 
        'categoria_id', 
        'demandante_id', 
        'campus_id', 
        'setor_responsavel_id',
        'tipo_contato_id'
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

    public function listAllOccurrences($filtro)
    {

        return DB::table('ouvidorias_ocorrencias as ocorrencia')
            ->join('ouvidorias_categorias as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidorias_demandantes as demandante', 'demandante.id', '=', 'ocorrencia.demandante_id')
            ->join('ouvidorias_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('campus', 'campus.id', '=', 'ocorrencia.campus_id')
            ->join('setores', 'setores.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->orderBy('ocorrencia.status_id', 'asc')
            ->where('ocorrencia.protocolo', '=' , $filtro)
            ->orWhere('ocorrencia.nome', 'LIKE', '%'. $filtro . '%')
            ->select(
                    'ocorrencia.id',
                    'ocorrencia.protocolo', 
                    'ocorrencia.nome',
                    'ocorrencia.contato as contato', 
                    'ocorrencia.tipo_contato_id', 
                    'ocorrencia.descricao', 
                    'categoria.nome as categoria',
                    'demandante.nome as demandante',
                    'campus.nome as campus', 
                    'status.nome as status', 
                    'ocorrencia.status_id',
                    'ocorrencia.created_at as data', 
                    'setores.nome as setor_responsavel', 
                    'ocorrencia.setor_responsavel_id')
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

    public function report()
    {
        return [
            'DEMANDANTES'   =>  DB::table('ouvidorias_ocorrencias as ocorrencias')
                                    ->join('ouvidorias_demandantes as demandantes', 'demandantes.id', '=', 'ocorrencias.demandante_id')
                                    ->whereRaw('MONTH(ocorrencias.created_at) = MONTH(CURDATE())')
                                    ->groupBy('demandantes.nome')
                                    ->orderBy('QTD_DEMANDANTE', 'DESC')
                                    ->selectRaw('
                                        demandantes.nome as DEMANDANTES, 
                                        count(ocorrencias.demandante_id) as QTD_DEMANDANTE, 
                                        count(ocorrencias.demandante_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100 as PORCENTAGEM, 
                                        (SELECT COUNT(*) from ouvidorias_ocorrencias) as TOTAL_OCORRENCIAS, 
                                        (select count(ocorrencias.demandante_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100 as PORCENTAGEM
                                    from 
                                        ouvidorias_ocorrencias as ocorrencias
                                    join ouvidorias_demandantes as demandantes 
                                        on demandantes.id = ocorrencias.demandante_id
                                    where 
                                        MONTH(ocorrencias.created_at) = MONTH(CURDATE())
                                    ) as PORCENTAGEM_TOTAL')
                                    ->get(),
            'DEMANDAS'      =>  DB::table('ouvidorias_ocorrencias as ocorrencias')
                                    ->join('ouvidorias_categorias as categorias', 'categorias.id' ,'=', 'ocorrencias.categoria_id')
                                    ->whereRaw('MONTH(ocorrencias.created_at) = MONTH(CURDATE())')
                                    ->groupBy('categorias.nome')
                                    ->orderBy('QTD_CATEGORIA', 'DESC')
                                    ->selectRaw('
                                        categorias.nome as CATEGORIAS, 
                                        count(ocorrencias.categoria_id) as QTD_CATEGORIA, 
                                        count(ocorrencias.categoria_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100 as PORCENTAGEM, 
                                        (SELECT COUNT(*) from ouvidorias_ocorrencias) as TOTAL_OCORRENCIAS,
                                        (select count(ocorrencias.demandante_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100 as PORCENTAGEM
                                        from 
                                            ouvidorias_ocorrencias as ocorrencias
                                        join ouvidorias_demandantes as demandantes 
                                            on demandantes.id = ocorrencias.demandante_id
                                        where 
                                            MONTH(ocorrencias.created_at) = MONTH(CURDATE())
                                        ) as PORCENTAGEM_TOTAL')
                                    ->get(),
            'RECLAMACOES'   =>  DB::table('ouvidorias_ocorrencias as ocorrencias')
                                    ->join('campus', 'campus.id', '=', 'ocorrencias.campus_id')
                                    ->join('ouvidorias_demandantes as demandantes', 'demandantes.id', '=', 'ocorrencias.demandante_id')
                                    ->whereRaw('MONTH(ocorrencias.created_at) = MONTH(CURDATE()) AND ocorrencias.categoria_id = 1')
                                    ->selectRaw('demandantes.nome as DEMANDANTE, ocorrencias.descricao as DESCRICAO, campus.nome as CAMPUS')
                                    ->get()
        ];
    }

    public function historicos()
    {
        return $this->hasMany(OuvidoriasHistorico::class, 'ocorrencia_id', 'id');
    }

    public function setorResponsavel()
    {
        return $this->hasOne(Setor::class, 'id', 'setor_responsavel_id');
    }

    public function categoria()
    {
        return $this->hasOne(OuvidoriasCategoria::class, 'id', 'categoria_id');
    }

    public function demandante()
    {
        return $this->hasOne(OuvidoriasDemandante::class, 'id', 'demandante_id');
    }

    public function status()
    {
        return $this->hasOne(OuvidoriaStatus::class, 'id', 'status_id');
    }

    public function campus()
    {
        return $this->hasOne(Campus::class, 'id', 'campus_id');
    }
}
