<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\OuvidoriaCategoria;
use App\Models\OuvidoriaDemandante;

class RecursosIniciaisOuvidoriaController extends Controller
{
    public function index()
    {
        return response()->json([
            'categorias_demandas' => OuvidoriaCategoria::all()->toArray(),
            'campus' => Campus::all()->toArray(),
            'categorias_demandantes' => OuvidoriaDemandante::all()->toArray()
        ], 200);
    }
}
