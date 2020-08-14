<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Ouvidoria extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'protocolo' => $this->protocolo,
            'contato' => $this->contato,
            'data_criacao' => $this->data_criacao,
            'setor_responsavel' => $this->setorResponsavel->nome,
            'categoria' => $this->categoria->nome,
            'demandante' => $this->demandante->nome,
            'status' => $this->status->nome,
            'campus' => $this->campus->nome,
            'historicos' => $this->historicos
        ];
    }
}
