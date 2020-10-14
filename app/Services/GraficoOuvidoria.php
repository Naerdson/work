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

    public function getDataDemandasAndDemandantesGoogleCharts($filtroMes)
    {
        $data = $this->ouvidoria->report($filtroMes);

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
            $arrayCategoriaDemandas[$demanda->nome] = $demanda->qtd_categoria_especifica;
        }

        return $arrayCategoriaDemandas;
    }

    private function transformDataDemandantes($data)
    {
        $arrayCategoriaDemandates = [];

        $arrayCategoriaDemandates['Demandantes'] = 'Quantidade';
        foreach ($data['DEMANDANTES'] as $demandante) {
            $arrayCategoriaDemandates[$demandante->nome] = $demandante->qtd_demandante_especifico;
        }

        return $arrayCategoriaDemandates;
    }
}