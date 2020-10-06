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

    public function getDataDemandasAndDemandantesGoogleCharts()
    {
        $data = $this->ouvidoria->report();

        return [
            'demandas' => $this->transformDataDemandas($data),
            'demandantes' => $this->transformDataDemandantes($data)
        ];
    }

    private function transformDataDemandas($data)
    {
        $arrayCategoriaDemandas = [];

        $arrayCategoriaDemandas['Demandas'] = 'Quantidade';
        foreach ($data['DEMANDAS'] as $demanda) {
            $arrayCategoriaDemandas[$demanda->CATEGORIAS] = $demanda->QTD_CATEGORIA;
        }

        return $arrayCategoriaDemandas;
    }

    private function transformDataDemandantes($data)
    {
        $arrayCategoriaDemandates = [];

        $arrayCategoriaDemandates['Demandantes'] = 'Quantidade';
        foreach ($data['DEMANDANTES'] as $demandante) {
            $arrayCategoriaDemandates[$demandante->DEMANDANTES] = $demandante->QTD_DEMANDANTE;
        }

        return $arrayCategoriaDemandates;
    }
}