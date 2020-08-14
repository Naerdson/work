<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Helpers;
use App\Http\Resources\Ouvidoria as OuvidoriaResource;
use App\Models\OuvidoriasOcorrencia;
use Illuminate\Support\Facades\Mail;
use Exception;

class OuvidoriaController extends Controller
{

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

            $ouvidoriaInstance = OuvidoriasOcorrencia::create(array_merge(
                $request->post(),
                [
                    'protocolo' => $functions->generateProtocol(2)
                ]
            ));

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
                        'protocolo' => $ouvidoriaInstance->protocolo
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

    public function show(Request $request)
    {
        try {
            $protocolo = $request->input('protocolo');

            $ouvidoriaComHistorico = OuvidoriaResource::collection(
                OuvidoriasOcorrencia::where('protocolo', $protocolo)->get()
            );

            if(count($ouvidoriaComHistorico)){
                return response()->json([
                    'message' => 'Ouvidoria selecionada com sucesso',
                    'ouvidoria' => $ouvidoriaComHistorico
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
