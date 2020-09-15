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

        return view('admin.ouvidoria.home', [
            'ouvidorias' => $this->ouvidoria->listAllOccurrences($filtro, $status),
            'countOuvidoria' => $this->ouvidoria->getCountOuvidoria(),
            'setores' => Setor::all()
        ]);
    }
}
