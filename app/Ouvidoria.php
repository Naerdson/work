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
            ->join('ouvidoria_demandante as demandante', 'demandante.id', '=', 'ocorrencia.demandante_id')
            ->join('ouvidoria_status as status', 'status.id', '=', 'ocorrencia.status_id')
            ->join('campus', 'campus.id', '=', 'ocorrencia.campus_id')
            ->join('setor', 'setor.id', '=' , 'ocorrencia.setor_responsavel_id')
            ->orderBy('created_at', 'desc')
            ->select('ocorrencia.id','ocorrencia.protocolo', 'ocorrencia.nome','ocorrencia.contato as email', 'ocorrencia.descricao','categoria.nome as categoria','demandante.nome as demandante', 'campus.nome as campus', 'status.nome as status', 'ocorrencia.status_id','ocorrencia.created_at as data', 'setor.nome as setor_responsavel', 'ocorrencia.setor_responsavel_id')
            ->paginate(5);

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

    public function getCountOuvidoriaWithStatus()
    {
        return [
            'total' => DB::table('ouvidoria_ocorrencia')->count(),
            'encaminhado' => DB::table('ouvidoria_ocorrencia')->where('status_id', '2')->count(),
            'concluido' => DB::table('ouvidoria_ocorrencia')->where('status_id', '3')->count(),
            'aberto' => DB::table('ouvidoria_ocorrencia')->where('status_id', '1')->count(),
        ];
    }

    public function historic()
    {
        return $this->hasMany(HistoricoOuvidoria::class);
    }



}
