<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\OuvidoriasCategoria;
use App\Models\OuvidoriasDemandante;

class RecursosIniciaisOuvidoriaController extends Controller
{
    public function index()
    {
        return response()->json([
            'categorias_demandas' => OuvidoriasCategoria::all()->toArray(),
            'campus' => Campus::all()->toArray(),
            'categorias_demandantes' => OuvidoriasDemandante::all()->toArray()
        ], 200);
    }
}
