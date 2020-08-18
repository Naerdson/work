<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Mail\ResponderOuvidoria;
use Illuminate\Http\Request;
use App\Models\OuvidoriasHistorico;
use App\Models\OuvidoriasOcorrencia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Exception;

class HistoricoController extends Controller
{
    private $ouvidoria = null;
    private $historico = null;

    public function __construct(OuvidoriasOcorrencia $ouvidoria, OuvidoriasHistorico $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    /**
     * Encaminhar ocorrencia
     */
    public function forwardOccurrence(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'ocorrencia_id' => 'required',
                'status_ocorrencia_id' => 'required',
                'setor_id' => 'required'
            ]);

            $historicoInstance = $this->historico->fill(array_merge(
                $request->post(),
                [
                    'user_id' => (string) auth()->user()->id,
                ]
            ));

            $historicoInstance->save();

            $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $request->ocorrencia_id);
            $ouvidoriaInstance->update([ "status_id" => 2, "setor_responsavel_id" => $request->setor_id ]);

            return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria encaminhada com sucesso' ]);

        } catch (Exception $e) {
            return redirect()->route('ouvidoria.home')->with(['type' => 'danger', 'message' => 'Não foi possivel encaminhar a ocorrencia' . $e->getMessage() ]);
        }

    }

    /**
     * Responder ocorrencia por emil
     */
    public function replyOccurrenceByEmail(Request $request)
    {

        try {

            $validatedData = $request->validate([
                'ocorrencia_id' => 'required',
                'status_ocorrencia_id' => 'required',
                'mensagem' => 'required'
            ]);

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
                'mensagem' => $request->mensagem
            ];

            Mail::send(new ResponderOuvidoria($ouvidoriaInstance, $dataEmail));

            $ouvidoriaInstance->update([ "status_id" => 3, "setor_responsavel_id" => Auth::user()->setor_id ]);

            return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria respondida com sucesso' ]);

        }catch (Exception $e){
            return redirect()->route('ouvidoria.home')->with(['type' => 'danger', 'message' => 'Não foi possivel responder ouvidoria por email' . $e->getMessage()]);
        }
    }

    public function finishOccurrence($id)
    {
        $historicoInstance = $this->historico->fill(
            [
                'ocorrencia_id' => $id,
                'status_ocorrencia_id' => 4,
                'user_id' => Auth::user()->id,
                'setor_id' => Auth::user()->setor_id
            ]
        );


        $historicoInstance->save();

        $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $id);
        $ouvidoriaInstance->update([ "status_id" => 4, "setor_responsavel_id" => 11 ]);

        return redirect()->route('ouvidoria.home')->with(['type' => 'success', 'message' => 'Ouvidoria encerrada com sucesso' ]);
    }

    public function getHistoric($id)
    {
        $historicos = OuvidoriasHistorico::where('ocorrencia_id', $id)->get()->toArray();

        return view('admin.ouvidoria.historico', compact('historicos'));
    }
}
