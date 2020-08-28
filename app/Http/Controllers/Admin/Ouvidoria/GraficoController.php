<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OuvidoriasOcorrencia;

class GraficoController extends Controller
{
    private $ouvidoria;

    public function __construct(OuvidoriasOcorrencia $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }

    public function index()
    {
        $data = $this->ouvidoria->report();

        $arrayCategoria = [];
        foreach ($data['DEMANDAS'] as $demanda) {
            $arrayCategoria[$demanda->CATEGORIAS] = $demanda->QTD_CATEGORIA;
        }

        foreach ($data['DEMANDANTES'] as $demandante) {
            $arrayCategoria[$demandante->DEMANDANTES] = $demandante->QTD_DEMANDANTE;
        }
        return response()->json($arrayCategoria);
    }

    private function sanitize($data)
    {
        
    }
}
