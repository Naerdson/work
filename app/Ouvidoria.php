<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use DB;


class Ouvidoria extends Model
{
    protected $table = 'ouvidoria_ocorrencia';
    protected $fillable = [
        'nome', 'protocolo', 'contato', 'descricao', 'status_id', 'categoria_id', 'demandante_id', 'campus_id', 'setor_responsavel_id'
    ];


    public function listAllOccurrences()
    {
        $ocurrencesOmbudsman = DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->select('ocorrencia.id','ocorrencia.protocolo','ocorrencia.contato as email','categoria.nome as categoria', 'status.nome as status', 'ocorrencia.status_id','ocorrencia.created_at as data', 'setor.nome as setor_responsavel', 'ocorrencia.setor_responsavel_id')
            ->get();

        return $ocurrencesOmbudsman;
    }

    public function getOuvidoriaWhereProtocol($protocolo)
    {
        $ocurrence = DB::table('ouvidoria_ocorrencia as ocorrencia')
            ->join('ouvidoria_categoria as categoria', 'categoria.id', '=', 'ocorrencia.categoria_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->where('ocorrencia.protocolo', '=', $protocolo)
            ->select('ocorrencia.id','ocorrencia.protocolo','ocorrencia.contato as email','categoria.nome as categoria', 'status.nome as status','ocorrencia.created_at as data', 'setor.nome as setor_responsavel')
            ->first();

        return $ocurrence;

    }

    public function historic()
    {
        return $this->hasMany(HistoricoOuvidoria::class);
    }



}
