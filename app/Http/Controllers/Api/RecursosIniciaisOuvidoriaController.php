<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use App\Models\OpcaoPesquisaSatisfacao;
use App\Models\OuvidoriasCategoria;
use App\Models\OuvidoriasDemandante;
use App\Models\PerguntasPesquisa;
use App\Models\Setor;
use App\Models\TiposContato;

class RecursosIniciaisOuvidoriaController extends Controller
{

    public function index()
    {
        return response()->json([
            'categorias_demandas' => OuvidoriasCategoria::all()->toArray(),
            'campus' => Campus::all()->toArray(),
            'categorias_demandantes' => OuvidoriasDemandante::all()->toArray(),
            'tipos_contato' => TiposContato::all()->toArray(),
            'setores' => Setor::all()->toArray()
        ], 200);
    }
}
