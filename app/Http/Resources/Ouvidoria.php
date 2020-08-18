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
            'setor_responsavel' => $this->setorResponsavel->nome,
            'categoria' => $this->categoria->nome,
            'status' => $this->status->nome,
            'historicos' => $this->historicos
        ];
    }
}
