<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use DB;

class Ouvidoria extends Model
{
    protected $table = 'ouvidoria_ocorrencia';
    protected $fillable = [
        'nome', 'protocolo', 'contato', 'descricao', 'status_id', 'categoria_id', 'demandante_id', 'campus_id'
    ];

    public function listAllOccurrencesInOmbudsman()
    {
        $ocurrencesOmbudsman = DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->select('ocorrencia.id','ocorrencia.protocolo' ,'categoria.nome as categoria', 'status.nome as status', 'ocorrencia.created_at as data')
            ->get();
        return $ocurrencesOmbudsman;
    }

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

}
