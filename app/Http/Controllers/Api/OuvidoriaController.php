<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Helpers;
use App\Models\HistoricoOuvidoria;
use App\Models\Ouvidoria;
use Illuminate\Support\Facades\Mail;
use Exception;

class OuvidoriaController extends Controller
{
    private $ouvidoria;
    private $historico;

    public function __construct(Ouvidoria $ouvidoria, HistoricoOuvidoria $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    public function index(Request $request)
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

    public function store(Request $request, helpers $functions)
    {
        try {

            $this->validate($request, [
                'nome' => 'string|nullable',
                'contato' => 'email|required',
                'descricao' => 'string|required',
                'categoria_id' => 'required|integer',
                'demandante_id' => 'required|integer',
                'campus_id' => 'required|integer'
            ]);


            $ouvidoriaInstance = $this->ouvidoria->fill(array_merge(
                $request->post(),
                [
                    'protocolo' => $functions->generateProtocol(2)
                ]
            ));

            $ouvidoriaInstance->save();
            if($ouvidoriaInstance){

               $contatoEmail = $ouvidoriaInstance->contato;
               $numeroProtocolo = $ouvidoriaInstance->protocolo;

               Mail::send('emails.confirmacao-ouvidoria', ['protocolo' => $numeroProtocolo], function ($message) use ($contatoEmail) {
                   $message->to($contatoEmail);
                   $message->from('sistemas@unifametro.edu.br','Unifametro');
                   $message->subject('Recebemos sua solicitação.');
               });

                return response()->json([
                    'message' => 'Ouvidoria aberta com sucesso',
                    'docs' => [
                        'ouvidoria' => $ouvidoriaInstance->toArray()
                    ]
                ], 201);
            }
        }
        catch (Exception $e){
            return response()->json([
                'message' => 'Ocorreu um erro ao salvar a ouvidoria. Tente novamente.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
