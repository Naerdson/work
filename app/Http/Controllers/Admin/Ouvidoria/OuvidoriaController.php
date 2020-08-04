<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\HistoricoOuvidoria;
use App\Http\Controllers\Controller;
use App\Setor;
use Illuminate\Http\Request;
use App\Ouvidoria;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\Helpers\helpers;

date_default_timezone_set('America/Sao_Paulo');

class OuvidoriaController extends Controller
{
    private $ouvidoria;

    public function __construct(Ouvidoria $ouvidoria, HistoricoOuvidoria $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }

    public function index()
    {
        $ouvidorias = $this->ouvidoria->listAllOccurrences();
        $listCountOuvidoria = $this->ouvidoria->getCountOuvidoria();
        $setores = Setor::all();

        return view('admin.ouvidoria.home', compact('ouvidorias', 'listCountOuvidoria', 'setores'));
    }
}
