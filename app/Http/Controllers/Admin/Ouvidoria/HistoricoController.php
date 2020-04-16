<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ouvidoria;
use App\HistoricoOuvidoria;
use Auth;

class HistoricoController extends Controller
{
    private $ouvidoria = null;
    private $historico = null;

    public function __construct(Ouvidoria $ouvidoria, HistoricoOuvidoria $historico)
    {
        $this->ouvidoria = $ouvidoria;
        $this->historico = $historico;
    }
    public function forwardOccurrence(Request $request)
    {
        try {
            $historicoInstance = $this->historico->fill(array_merge(            
                $request->post(),
                [
                    'user_id' => (string) Auth::user()->id
                ]
            ));
    
            $historicoInstance->save();
    
            $ouvidoriaInstance = $this->ouvidoria->findOrFail( (int) $request->ocorrencia_id);   
            $ouvidoriaInstance->update([ "status_id" => 2 ]);
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
