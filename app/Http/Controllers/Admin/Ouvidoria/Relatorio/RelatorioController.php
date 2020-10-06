<?php

namespace App\Http\Controllers\Admin\Ouvidoria\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\OuvidoriasOcorrencia;
use App\Services\GraficoOuvidoria as ChartsOuvidoriaService;
use PDF;

class RelatorioController extends Controller
{
    private $ouvidoria;
    private $graficos;

    public function __construct(OuvidoriasOcorrencia $ouvidoria, ChartsOuvidoriaService $chartsService)
    {
        $this->ouvidoria = $ouvidoria;
        $this->graficos = $chartsService;
    }

    public function index()
    {
        return view('admin.ouvidoria.relatorio', [
            'relatorios' => $this->ouvidoria->report()
        ]);
    }

    public function getCharts()
    {
        return response()->json($this->graficos->getDataDemandasAndDemandantesGoogleCharts());
    }

    public function downloadReport() 
    {
        $pdf = PDF::loadView('admin.ouvidoria.relatorio.mensal', [
            'data' => $this->ouvidoria->report(),
            'graficos' => $this->graficos->getDataDemandasAndDemandantesGoogleCharts()
        ]);

        $pdf->setOptions([
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'enable-smart-shrinking' => true,
            'page-size' => 'a4',
            'footer-center' => '[page]'
        ]);

        return $pdf->stream();
        
        return $pdf->download('RelatorioOuvidoria.pdf');
    }
}
