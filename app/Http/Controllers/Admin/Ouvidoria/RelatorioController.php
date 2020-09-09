<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Models\OuvidoriasOcorrencia;
use App\Services\GraficoOuvidoria as GraficoService;

class RelatorioController extends Controller
{
    private $ocorrencias;

    public function __construct(OuvidoriasOcorrencia $ocorrencias)
    {
        $this->ocorrencias = $ocorrencias;
    }
    
    public function index()
    {
        $relatorios = $this->ocorrencias->report();
        
        return view('admin.ouvidoria.graficos', compact('relatorios'));
    }

    public function getCharts(GraficoService $chartsService)
    {
        $dataCharts = $chartsService->getDataDemandasAndDemandantes();

        return response()->json($dataCharts);
    }
}
