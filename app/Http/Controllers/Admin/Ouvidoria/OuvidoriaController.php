<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\HistoricoOuvidoria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ouvidoria;
use Exception;
use Auth;
date_default_timezone_set('America/Sao_Paulo');

class OuvidoriaController extends Controller
{
    private $ouvidoria;
    private $historico;

    public function __construct(Ouvidoria $ouvidoria, HistoricoOuvidoria $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    public function index()
    {

        $ouvidorias = $this->ouvidoria->listAllOccurrences();
        $listCountOuvidoria = $this->ouvidoria->getCountOuvidoriaWithStatus();

        return view('admin.ouvidoria.home', compact('ouvidorias', 'listCountOuvidoria'));
    }

    public function store(Request $request)
    {

        try {
            $ouvidoriaInstance = $this->ouvidoria->fill(array_merge(
                $request->post(),
                [
                    'protocolo' =>  date("dmYHis")
                ]
            ));
            $ouvidoriaInstance->save();
            if($ouvidoriaInstance){

//                $contatoEmail = $ouvidoriaInstance->contato;
//                $numeroProtocolo = $ouvidoriaInstance->protocolo;
//
//                Mail::send('emails.confirmacao-ouvidoria', ['protocolo' => $numeroProtocolo], function ($message) use ($contatoEmail) {
//                    $message->to($contatoEmail);
//                    $message->from('sistemas@unifametro.edu.br','Unifametro');
//                    $message->subject('Recebemos sua solicitação.');
//                });

                return response()->json([
                    'message' => 'Ouvidoria aberta com sucesso',
                    'docs' => [
                        'ouvidoria' => $ouvidoriaInstance->toArray()
                    ]
                ], 200);
            }

        }
        catch (Exception $e){
            dd($e->getMessage());
        }
    }

    public function getOuvidoria(Request $request, HistoricoOuvidoria $historico)
    {
        try {
            $protocolo = $request->input('protocolo');

            return response()->json([
                'message' => 'Ouvidoria selecionada com sucesso',
                'docs' => [
                    'ouvidoria' => $this->ouvidoria->getOuvidoriaWhereProtocol($protocolo),
                    'historico' => $this->historico->getHistoricWithProtocolo($protocolo)
                ]
            ], 200);

        }
        catch (Exception $e){

        }


    }


}
