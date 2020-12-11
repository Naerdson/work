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

        // $data = PesquisaSatifacao::whereMonth('created_at', $filtroMes)->get()->groupBy('pergunta_id')->map(function ($pesquisa) {
        //     // return $pesquisa->transform(static function(PesquisaSatifacao $pesquisa) {
        //     //     return [
        //     //         'pergunta' => $pesquisa->pergunta->nome,
        //     //         'resposta' => $pesquisa->resposta->count()
        //     //     ];
        //     // });
        //     // return $pesquisa->map(function (PesquisaSatifacao $pesquisaSatifacao) {
        //     //     return [
        //     //         'pergunta' => $pesquisaSatifacao->pergunta->nome,
        //     //         'resposta' => $pesquisaSatifacao->resposta->count()
        //     //     ];
        //     // });
        // });

        // $data = OuvidoriasOcorrencia::whereMonth('created_at', $filtroMes)->get();

        // dd($data);
        // $pesquisa = $data->each(static function (PesquisaSatifacao $pesquisaSatifacao) {
        //     dd($pesquisaSatifacao);
        //     $resposta = OpcaoPesquisaSatisfacao::whereId($pesquisaSatifacao->resposta_id)->count();

        //     return [
        //         'pergunta' => $pesquisaSatifacao->pergunta->nome,
        //         'resposta' => $resposta
        //     ];
        // });

        // dd($pesquisa);
        // $pesquisas = $data->map(function($pesquisa) {
        //     return $pesquisa->transform(static function(PesquisaSatifacao $pesquisaSatifacao) {
        //         $respostas = DB::table('opcoes_pesquisa_satisfacao')->where('id', $pesquisaSatifacao->resposta_id);

        //         // return [
        //         //     'pergunta' => $pesquisaSatifacao->pergunta->nome,
        //         //     'respostas' => $respostas->count()
        //         // ];
        //     });
        // });



        $pdf = PDF::loadView('admin.ouvidoria.relatorio.mensal', [
            'data' => $this->ouvidoria->report($request->input('mes')),
            'graficos' => $this->graficos->getDataDemandasAndDemandantesGoogleCharts($request->input('mes')),
            'mes' => $filtroMes,
            'meses' => $this->getMonth(),
            // 'perguntas' => $pesquisa
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
