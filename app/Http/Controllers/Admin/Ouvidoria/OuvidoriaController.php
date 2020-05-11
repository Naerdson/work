<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\HistoricoOuvidoria;
use App\Http\Controllers\Controller;
use App\Setor;
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
        $setores = Setor::all();

        return view('admin.ouvidoria.home', compact('ouvidorias', 'listCountOuvidoria', 'setores'));
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
            return response()->json([
                'message' => 'Ocorreu um erro ao salvar a ouvidoria. Tente novamente.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getOuvidoria(Request $request, HistoricoOuvidoria $historico)
    {
        try {
            $protocolo = $request->input('protocolo');
            $ouvidoriaArray = $this->ouvidoria->where('protocolo', $protocolo)->get();


            if(count($ouvidoriaArray)){
                return response()->json([
                    'message' => 'Ouvidoria selecionada com sucesso',
                    'docs' => [
                        'ouvidoria' => $this->ouvidoria->getOuvidoriaWhereProtocol($protocolo),
                        'historico' => $this->historico->getHistoricWithProtocolo($protocolo)
                    ]
                ], 200);
            }

            return response()->json([
                'message' => 'Protocolo Incorreto'
            ], 422);

        }
        catch (Exception $e){
            return response()->json([
                'message' => 'Ocorreu um erro ao processar a requisição. Tente novamente.',
                'error' => $e->getMessage()
            ], 500);
        }


    }


}
