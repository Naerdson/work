<?php

namespace App\Http\Controllers\Admin\Ouvidoria\Relatorio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\OuvidoriasOcorrencia;

class OuvidoriaRelatorioController extends Controller
{

    public function __construct(OuvidoriasOcorrencia $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }

    public function index() 
    {
        $report = $this->ouvidoria->report();
        $pdf = PDF::loadView('admin.relatorio.ouvidoria', compact('report'));
        
        return $pdf->setPaper('a4')->download('ouvidoria_report.pdf');
    }
}
