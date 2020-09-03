<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Services\GraficoOuvidoria as GraficoService;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('admin.ouvidoria.graficos');
    }

    public function getCharts(GraficoService $chartsService)
    {
        $dataCharts = $chartsService->getDataDemandasAndDemandantes();

        return response()->json($dataCharts);
    }
}
