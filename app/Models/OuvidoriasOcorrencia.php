<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OuvidoriaStatus as StatusModel;
use Illuminate\Support\Facades\DB;
USE App\Models\Setor as SetorModel;

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
        return date('d/m/Y H:i:s', strtotime($this->attributes['created_at']));
    }

    public function listAllOccurrences($filtro, $status)
    {
        $operadorFiltroProtoloco = (is_null($filtro)) ? '!=' : '=';
        $status_id = $this->getIdStatus($status);

        $operadorFiltroStatus = ($status_id == 0) ? '>' : '='; 
        $operadorFiltroOuvidoria = (auth()->user()->setor_id == SetorModel::OUVIDORIA) ? '>' : '='; 
        $filtroSetor = (auth()->user()->setor_id == SetorModel::OUVIDORIA) ? 0 : auth()->user()->setor_id;

        return OuvidoriasOcorrencia::select('id', 'protocolo', 'nome', 'contato', 'tipo_contato_id', 'descricao', 'status_id', 'created_at', 'setor_responsavel_id', 'categoria_id', 'demandante_id', 'campus_id', 'status_id')
                ->where('setor_responsavel_id', $operadorFiltroOuvidoria, $filtroSetor)
                ->where('status_id', $operadorFiltroStatus, $status_id)
                ->where('protocolo', $operadorFiltroProtoloco , $filtro)
                ->paginate(5);
    }

    private function getIdStatus($status)
    {
        switch ($status) {
            case 'encaminhado':
                return StatusModel::STATUS_ENCAMINHADO;
            case 'concluido':
                return StatusModel::STATUS_CONCLUIDO;
            case 'aberto':
                return StatusModel::STATUS_ABERTO;
            case 'total':
                return 0;
            default:
                return 0;
        }
    }

    public function getCountOuvidoria()
    {
        return [
            'total' => OuvidoriasOcorrencia::count(),
            'encaminhado' => OuvidoriasOcorrencia::where('status_id', StatusModel::STATUS_ENCAMINHADO)->count(),
            'concluido' => OuvidoriasOcorrencia::where('status_id', StatusModel::STATUS_CONCLUIDO)->count(),
            'aberto' => OuvidoriasOcorrencia::where('status_id', StatusModel::STATUS_ABERTO)->count(),
        ];
    }

    public function report()
    {
        $reclamacaoOuvidoriaID = OuvidoriasCategoria::RECLAMACAO;

        return [
            'DEMANDANTES'   =>  DB::table('ouvidorias_ocorrencias as ocorrencias')
                                    ->join('ouvidorias_demandantes as demandantes', 'demandantes.id', '=', 'ocorrencias.demandante_id')
                                    ->whereRaw('MONTH(ocorrencias.created_at) = MONTH(CURDATE())')
                                    ->groupBy('demandantes.nome')
                                    ->orderBy('QTD_DEMANDANTE', 'DESC')
                                    ->selectRaw('
                                        demandantes.nome as DEMANDANTES, 
                                        count(ocorrencias.demandante_id) as QTD_DEMANDANTE, 
                                        TRUNCATE(count(ocorrencias.demandante_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100, 1) as PORCENTAGEM, 
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
                                        TRUNCATE(count(ocorrencias.categoria_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias) * 100, 1) as PORCENTAGEM, 
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
            'RECLAMACOES'   =>  OuvidoriasOcorrencia::whereRaw("MONTH(ouvidorias_ocorrencias.created_at) = MONTH(CURDATE()) AND ouvidorias_ocorrencias.categoria_id = {$reclamacaoOuvidoriaID}")
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
