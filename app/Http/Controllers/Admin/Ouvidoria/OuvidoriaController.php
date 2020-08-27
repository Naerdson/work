<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use App\Models\Setor;
use App\Models\OuvidoriasOcorrencia;
use Illuminate\Http\Request;

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

        $ouvidorias = $this->ouvidoria->listAllOccurrences($filtro);
        $listCountOuvidoria = $this->ouvidoria->getCountOuvidoria();
        $setores = Setor::all();
        
        return view('admin.ouvidoria.home', compact('ouvidorias', 'listCountOuvidoria', 'setores'));
    }
}
