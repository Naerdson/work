<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Models\Setor;
use App\Models\OuvidoriasOcorrencia;
use Illuminate\Http\Request;
use PDF;


class OuvidoriaController extends Controller
{
    private $ouvidoria;

    public function __construct(OuvidoriasOcorrencia $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }

    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        $status = $request->get('status');

        // $pdf = PDF::loadView('admin.pdf.layout');
        // $pdf->setOptions([
        //     'enable-javascript' => true,
        //     'javascript-delay'  => 1000,
        //     'no-stop-slow-scripts' => true,
        //     'enable-smart-shrinking' => true
        // ]);
        // // $pdf->setOption('enable-javascript', true);
        // // $pdf->setOption('javascript-delay', 1000);
        // // $pdf->setOption('no-stop-slow-scripts', true);
        // // $pdf->setOption('enable-smart-shrinking', true);

        // return $pdf->stream();

        return view('admin.ouvidoria.home', [
            'ouvidorias' => $this->ouvidoria->listAllOccurrences($filtro, $status),
            'countOuvidoria' => $this->ouvidoria->getCountOuvidoria(),
            'setores' => Setor::all()
        ]);
    }
}
