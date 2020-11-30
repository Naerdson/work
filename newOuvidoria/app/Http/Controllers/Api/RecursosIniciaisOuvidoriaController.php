<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\CategoriaDemandante;
use App\Models\OuvidoriaCategoriaDemanda;

class RecursosIniciaisOuvidoriaController extends Controller
{
    public function index()
    {
        $demandas = OuvidoriaCategoriaDemanda::all()->toArray();
        $campus = Campus::all()->toArray();
        $demandantes = CategoriaDemandante::all()->toArray();

        return response()->json([
            'categorias_demandas' => $demandas,
            'campus' => $campus,
            'categorias_demandantes' => $demandantes
        ], 200);
    }
}
