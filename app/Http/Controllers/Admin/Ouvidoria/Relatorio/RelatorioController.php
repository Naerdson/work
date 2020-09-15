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
            'relatorios' => $this->ouvidoria->report(),
            'graficos' => $this->graficos->getDataDemandasAndDemandantes()
        ]);
    }

    public function getCharts()
    {
        return response()->json($this->graficos->getDataDemandasAndDemandantes());
    }

    public function downloadReport() 
    {

        $pdf = PDF::loadView('admin.ouvidoria.relatorio.mensal', [
            'data' => $this->ouvidoria->report()
        ]);

        $pdf->setOptions([
            'page-size' => 'a4',
            'footer-center' => '[page]'
        ]);
        
        return $pdf->download('RelatorioOuvidoria.pdf');
    }
}
