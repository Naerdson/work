<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OuvidoriaStatus as StatusModel;
use Illuminate\Support\Facades\DB;
use App\Models\Setor as SetorModel;
use Carbon\Carbon;

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
        'causa_id',
        'setor_responsavel_id',
        'tipo_contato_id'
    ];

    protected $with = [
        'setor_responsavel',
        'categoria',
        'demandante',
        'status',
        'campus',
        'historicos',
        'causa'
    ];

    protected $hidden = [
        'categoria_id',
        'demandante_id',
        'status_id',
        'campus_id',
        'setor_responsavel_id',
        'updated_at'
    ];


    public function listAllOccurrences($filtro, $status)
    {
        $operadorFiltroProtoloco = (is_null($filtro)) ? '!=' : '=';
        $status_id = $this->getIdStatus($status);

        $operadorFiltroStatus = ($status_id == 0) ? '>' : '=';
        $operadorFiltroOuvidoria = (auth()->user()->setor_id == SetorModel::OUVIDORIA) ? '>' : '=';
        $filtroSetor = (auth()->user()->setor_id == SetorModel::OUVIDORIA) ? 0 : auth()->user()->setor_id;

        return self::select('id', 'protocolo', 'nome', 'contato', 'tipo_contato_id', 'descricao', 'status_id', 'created_at', 'setor_responsavel_id', 'categoria_id', 'demandante_id', 'campus_id', 'causa_id')
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
            'total' => self::count(),
            'encaminhado' => self::where('status_id', StatusModel::STATUS_ENCAMINHADO)->count(),
            'concluido' => self::where('status_id', StatusModel::STATUS_CONCLUIDO)->count(),
            'aberto' => self::where('status_id', StatusModel::STATUS_ABERTO)->count(),
        ];
    }

    public function report($filtroMes)
    {
        $filtroMes = (is_null($filtroMes) ? Carbon::now()->month : (int) $filtroMes);
        $reclamacaoOuvidoriaID = OuvidoriasCategoria::RECLAMACAO;
        $pesquisaSatifacaoOcorrencias = PesquisaSatifacao::select('id', 'pergunta_id')->whereMonth('created_at', $filtroMes)->groupBy('pergunta_id')->get();

        return [
            'DEMANDANTES'   =>  DB::select("
                                    select
                                        demandante.nome,
                                        count(ocorrencia.demandante_id) as qtd_demandante_especifico,
                                        cast(100. * count(ocorrencia.demandante_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias where month(created_at) = {$filtroMes}) as decimal(10,2)) as porcentagem_individual,
                                        (SELECT COUNT(*) from ouvidorias_ocorrencias where MONTH(created_at) = {$filtroMes}) as total_ocorrencias
                                    from
                                        ouvidorias_ocorrencias as ocorrencia
                                        join ouvidorias_demandantes as demandante
                                            on demandante.id = ocorrencia.demandante_id
                                    where
                                        month(ocorrencia.created_at) = {$filtroMes}
                                        group by demandante.nome;
                                "),
            'DEMANDAS'      =>  DB::select("
                                    select
                                        categoria.nome,
                                        count(ocorrencia.categoria_id) as qtd_categoria_especifica,
                                        cast(100. * count(ocorrencia.categoria_id) / (SELECT COUNT(*) from ouvidorias_ocorrencias where month(created_at) = {$filtroMes}) as decimal(10,2)) as porcentagem_individual,
                                        (SELECT COUNT(*) from ouvidorias_ocorrencias where MONTH(created_at) = {$filtroMes}) as total_ocorrencias
                                    from
                                        ouvidorias_ocorrencias as ocorrencia
                                        join ouvidorias_categorias as categoria
                                            on categoria.id = ocorrencia.categoria_id
                                    where
                                        month(ocorrencia.created_at) = {$filtroMes}
                                        group by categoria.nome;
                                "),
            'RECLAMACOES'   =>  self::whereRaw("MONTH(ouvidorias_ocorrencias.created_at) = {$filtroMes} AND ouvidorias_ocorrencias.categoria_id = {$reclamacaoOuvidoriaID}")->get(),
            'PESQUISA_SATISFACAO' => $pesquisaSatifacaoOcorrencias->map(static function ($pesquisaSatifacao) use ($filtroMes, $pesquisaSatifacaoOcorrencias){
                    $respostas = PesquisaSatifacao::select(
                        'opcoes_pesquisa_satisfacao.nome',
                        DB::raw(
                            "count(pesquisa_satisfacao.resposta_id) as qtd,
                            cast(100 * count(pesquisa_satisfacao.resposta_id) / (SELECT COUNT(*) from pesquisa_satisfacao where month(created_at) = {$filtroMes} and pesquisa_satisfacao.pergunta_id = {$pesquisaSatifacao->id}) as decimal(10,2)) as porcentagem"),
                         )
                        ->join('opcoes_pesquisa_satisfacao', 'opcoes_pesquisa_satisfacao.id', 'pesquisa_satisfacao.resposta_id')
                        ->whereMonth('pesquisa_satisfacao.created_at', $filtroMes)
                        ->where('pesquisa_satisfacao.pergunta_id', $pesquisaSatifacao->id)
                        ->groupBy('opcoes_pesquisa_satisfacao.nome')
                        ->get();

                        return [
                            'pergunta' => $pesquisaSatifacao->pergunta->nome,
                            'resposta' => $respostas
                        ];
            })
        ];
    }

    public function historicos()
    {
        return $this->hasMany(OuvidoriasHistorico::class, 'ocorrencia_id', 'id');
    }

    public function setor_responsavel()
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

    public function observao_pesquisa_satisfacao()
    {
        return $this->hasOne(ObservacaoPesquisaSatisfacao::class, 'ocorrencia_id', 'id');
    }

    public function causa()
    {
        return $this->hasOne(Causa::class, 'id', 'causa_id');
    }

}
