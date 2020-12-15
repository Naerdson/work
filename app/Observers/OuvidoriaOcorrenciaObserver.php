<?php

namespace App\Observers;

use App\OuvidoriasOcorrencia;

class OuvidoriaOcorrenciaObserver
{
    /**
     * Handle the ouvidorias ocorrencia "created" event.
     *
     * @param  \App\OuvidoriasOcorrencia  $ouvidoriasOcorrencia
     * @return void
     */
    public function created(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        //
    }

    /**
     * Handle the ouvidorias ocorrencia "updated" event.
     *
     * @param  \App\OuvidoriasOcorrencia  $ouvidoriasOcorrencia
     * @return void
     */
    public function updated(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        if ($ouvidoriasOcorrencia->isDirty('status_id')) {
            switch ($ouvidoriasOcorrencia->status) {
                case '2':
                    // Logica para encaminhar a ocorrencia
                    $this->criarHistorico($ouvidoriasOcorrencia);
                    break;
                case '3':
                    // Implementação de disparo do email
                    $dataEmail = [
                        'mensagem' => $request->mensagem
                    ];

                    Mail::send(new ResponderOuvidoria($ouvidoriaInstance, $dataEmail));

                    $this->criarHistorico($ouvidoriasOcorrencia);
                case '4':
                    $this->criarHistorico($ouvidoriasOcorrencia);
                default:
                    # code...
                    break;
            }
        }
        
    }

    /**
     * Handle the ouvidorias ocorrencia "deleted" event.
     *
     * @param  \App\OuvidoriasOcorrencia  $ouvidoriasOcorrencia
     * @return void
     */
    public function deleted(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        //
    }

    /**
     * Handle the ouvidorias ocorrencia "restored" event.
     *
     * @param  \App\OuvidoriasOcorrencia  $ouvidoriasOcorrencia
     * @return void
     */
    public function restored(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        //
    }

    /**
     * Handle the ouvidorias ocorrencia "force deleted" event.
     *
     * @param  \App\OuvidoriasOcorrencia  $ouvidoriasOcorrencia
     * @return void
     */
    public function forceDeleted(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        //
    }

    public function criarHistorico(OuvidoriasOcorrencia $ouvidoriasOcorrencia)
    {
        $historicoInstance = OuvidoriasHistorico::create(array_merge(
            [
                'ocorrencia_id' => $ouvidoriasOcorrencia->id,
                'status_ocorrencia_id' => $ouvidoriasOcorrencia->status_id,
                'setor_id' => $ouvidoriasOcorrencia->setor_responsavel_id
            ],    
            [
                'user_id' => (string) auth()->user()->id,
            ]
        ));
    }
}
