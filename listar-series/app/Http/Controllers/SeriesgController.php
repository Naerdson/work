<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\seriesFormRequest;
class SeriesgController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $series = Serie::query()
            -> orderby('nome')
            ->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index',compact('series','mensagem'));

    }

    public function create ()
    {
        return view('series.create');

    }

    public function store(seriesFormRequest $request)
    {

        $serie = Serie::create($request->all());
        $request->session()
            ->flash(
                'mensagem',
                "Cadastro  criado com sucesso {$serie->nome}"
            );

        return redirect()->route ('listar_series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Cadastro excluido com sucesso!"
            );
        return redirect()->route ('listar_series');

    }
}
