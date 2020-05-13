<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoricoOuvidoria extends Model
{
    protected $table = 'ouvidoria_historico';

    protected $fillable = ['ocorrencia_id', 'status_ocorrencia_id', 'setor_id', 'user_id'];

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

    public function getHistoricWithProtocolo($protocolo)
    {
        // Rodar no mysql para formatar a data em portugues - SET GLOBAL lc_time_names=pt_BR;

        return DB::table('ouvidoria_ocorrencia AS ocorrencia')
            ->join('ouvidoria_historico AS historico', 'historico.ocorrencia_id', '=', 'ocorrencia.id')
            ->join('setor', 'setor.id', '=', 'historico.setor_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'historico.status_ocorrencia_id')
            ->where('protocolo', $protocolo)
            ->select('historico.id as historico_id', 'setor.nome as setor', 'status.nome as status', DB::raw('DATE_FORMAT(historico.created_at, "%d de %M de %Y") as data'))
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
}
