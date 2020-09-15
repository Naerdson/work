<?php

namespace App\Services;
use App\Models\OuvidoriasOcorrencia;

class GraficoOuvidoria 
{
    private $ouvidoria;

    public function __construct(OuvidoriasOcorrencia $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }

    public function getDataDemandasAndDemandantes()
    {
        $data = $this->ouvidoria->report();

        $arrayCategoriaDemandas = [];

        $arrayCategoriaDemandas['Demandas'] = 'Quantidade';
        foreach ($data['DEMANDAS'] as $demanda) {
            $arrayCategoriaDemandas[$demanda->CATEGORIAS] = $demanda->QTD_CATEGORIA;
        }
        

        $arrayCategoriaDemandates = [];
        $arrayCategoriaDemandates['Demandantes'] = 'Quantidade';
        foreach ($data['DEMANDANTES'] as $demandante) {
            $arrayCategoriaDemandates[$demandante->DEMANDANTES] = $demandante->QTD_DEMANDANTE;
        }

        return [
            'demandas' => $arrayCategoriaDemandas, 
            'demandantes' => $arrayCategoriaDemandates
        ];
    }
}