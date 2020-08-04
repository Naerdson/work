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
            "protocolo" => $this->protocolo,
            "nome" => $this->nome,
            "contato" => $this->contato,
            "descricao" => $this->descricao,
            "setor_responsavel_id" => $this->setor_responsavel_id,
            "data2" => $this->data2,
            "categoria" => $this->categoria,
            "demandante" => $this->demandante,
            "status" => $this->status,
            "campus" => $this->campus,
            "setor_responsavel" => $this->setor_responsavel
        ];
    }
}
