<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Models\Setor;
use App\Models\OuvidoriasHistorico;
use App\Models\OuvidoriasOcorrencia;
use Illuminate\Http\Request;

class OuvidoriaController extends Controller
{
    private $ouvidoria;

    public function __construct(OuvidoriasOcorrencia $ouvidoria, OuvidoriasHistorico $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    public function index(Request $request)
    {
        $protocoloOcorrencia = $request->get('protocolo');

        $ouvidorias = $this->ouvidoria->listAllOccurrences($protocoloOcorrencia);
        $listCountOuvidoria = $this->ouvidoria->getCountOuvidoria();
        $setores = Setor::all();


        return view('admin.ouvidoria.home', compact('ouvidorias', 'listCountOuvidoria', 'setores'));
    }
}
