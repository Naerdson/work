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
        $ocurrences = DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_historico as historico', 'ocorrencia.id', '=', 'historico.ocorrencia_id')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->where('historico.setor_id', $sector)
            ->select('ocorrencia.id','ocorrencia.protocolo' ,'categoria.nome as categoria', 'status.nome as status', 'ocorrencia.created_at as data')
            ->get();

        return $ocurrences;
    }

    public function getHistoricWithProtocolo($protocolo)
    {
        $historic = DB::table('ouvidoria_ocorrencia AS ocorrencia')
            ->join('ouvidoria_historico AS historico', 'historico.ocorrencia_id', '=', 'ocorrencia.id')
            ->join('setor', 'setor.id', '=', 'historico.setor_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'historico.status_ocorrencia_id')
            ->where('protocolo', $protocolo)
            ->select('historico.id as historico_id', 'setor.nome as setor', 'status.nome as status', 'historico.created_at as data')
            ->get();

        return $historic;
    }
}
