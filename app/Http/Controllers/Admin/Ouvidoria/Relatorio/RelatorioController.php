<?php

namespace App\Http\Controllers\Admin\Ouvidoria\Relatorio;

use App\Http\Controllers\Controller;
use App\Models\OpcaoPesquisaSatisfacao;
use App\Models\OuvidoriasOcorrencia;
use App\Models\PerguntasPesquisa;
use App\Models\PesquisaSatifacao;
use App\Services\GraficoOuvidoria as ChartsOuvidoriaService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ObservacaoPesquisaSatisfacao;
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

    public function index(Request $request)
    {
        return view('admin.ouvidoria.relatorio', [
            'relatorios' => $this->ouvidoria->report($request->input('mes')),
            'graficos' => $this->graficos->getDataDemandasAndDemandantesGoogleCharts($request->input('mes')),
            'meses' => $this->getMonth()
        ]);
    }

    public function downloadReport(Request $request)
    {
        $filtroMes = (is_null($request->input('mes')) ? Carbon::now()->month : (int) $request->input('mes'));

        $pdf = \PDF::loadView('admin.ouvidoria.relatorio.mensal', [
            'data' => $this->ouvidoria->report($request->input('mes')),
            'graficos' => $this->graficos->getDataDemandasAndDemandantesGoogleCharts($request->input('mes')),
            'observacoes_pesquisa_satisfacao' => ObservacaoPesquisaSatisfacao::whereMonth('created_at', $filtroMes)->get(),
            'mes' => $filtroMes,
            'meses' => $this->getMonth()
        ]);

        $pdf->setOptions([
            'enable-javascript' => true,
            'javascript-delay' => 1000,
            'no-stop-slow-scripts' => true,
            'enable-smart-shrinking' => true,
            'page-size' => 'a4',
            'footer-center' => '[page]'
        ]);

        return $pdf->stream('RelatorioOuvidoria.pdf');
    }

    public function getMonth()
    {
        return [
            "1" => "Janeiro",
            "2" => "Fevereiro",
            "3" => "Março",
            "4" => "Abril",
            "5" => "Maio",
            "6" => "Junho",
            "7" => "Julho",
            "8" => "Agosto",
            "9" => "Setembro",
            "10" => "Outubro",
            "11" => "Novembro",
            "12" => "Dezembro"
        ];
    }
}
