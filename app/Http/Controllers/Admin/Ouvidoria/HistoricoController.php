<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Mail\ResponderOuvidoria;
use Illuminate\Http\Request;
use App\Ouvidoria;
use App\HistoricoOuvidoria;
use Auth;
use Illuminate\Support\Facades\Mail;

class HistoricoController extends Controller
{
    private $ouvidoria = null;
    private $historico = null;

    public function __construct(Ouvidoria $ouvidoria, HistoricoOuvidoria $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    public function forwardOccurrence(Request $request)
    {

        try {
            $historicoInstance = $this->historico->fill(array_merge(
                $request->post(),
                [
                    'user_id' => (string) Auth::user()->id,
                ]
            ));

            $historicoInstance->save();

            $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $request->ocorrencia_id);
            $ouvidoriaInstance->update([ "status_id" => 2, "setor_responsavel_id" => $request->setor_id ]);

            return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria encaminhada com sucesso' ]);

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Responder ocorrencia por emil
     *
     * @return \Illuminate\Http\Response
     */
    public function replyOccurrenceByEmail(Request $request)
    {

        try {

            $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $request->ocorrencia_id);

            $historicoInstance = $this->historico->fill(array_merge(
                $request->post(),
                [
                    'user_id' => (string) Auth::user()->id,
                    'setor_id' => (string) Auth::user()->setor_id
                ]
            ));

            $historicoInstance->save();

            $dataEmail = [
                'email' => $ouvidoriaInstance->contato,
                'mensagem' => $request->mensagem
            ];


//            Mail::send(new ResponderOuvidoria(Auth::user(), $request));

            $ouvidoriaInstance->update([ "status_id" => 4, "setor_responsavel_id" => Auth::user()->setor_id ]);

            return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria respondida com sucesso' ]);

        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function finishOccurrence($id)
    {

        $historicoInstance = $this->historico->fill(
            [
                'ocorrencia_id' => $id,
                'status_ocorrencia_id' => 3,
                'user_id' => (string) Auth::user()->id,
                'setor_id' => (string) Auth::user()->setor_id
            ]
        );

        $historicoInstance->save();

        $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $id);
        $ouvidoriaInstance->update([ "status_id" => 3, "setor_responsavel_id" => 11 ]);

        return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria encerrada com sucesso' ]);
    }

    public function getHistoric($id)
    {
        $historics = $this->historico->getHistoric($id);

        return view('admin.ouvidoria.historico', compact('historics'));
    }



}
