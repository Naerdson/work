<?php

namespace App\Http\Controllers\Admin\Ouvidoria;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ouvidoria;
use Exception;
use Auth;

class OuvidoriaController extends Controller
{
    private $ouvidoria = null;

    public function __construct(Ouvidoria $ouvidoria)
    {
        $this->ouvidoria = $ouvidoria;
    }

    public function index(){

        $ouvidorias = $this->ouvidoria->listAllOccurrences();


        return view('admin.ouvidoria.home', compact('ouvidorias'));
    }

    public function store(Request $request)
    {

//        try {
//
//            $contatoEmail = $ouvidoriaInstance->contato;
//            $numeroProtocolo = $ouvidoriaInstance->protocolo;
//
//            Mail::send('emails.confirmacao-ouvidoria', ['protocolo' => $numeroProtocolo], function ($message) use ($contatoEmail) {
//                $message->to($contatoEmail);
//                $message->from('sistemas@unifametro.edu.br','Unifametro');
//                $message->subject('Recebemos sua solicitação.');
//            });
//
//            return response()->json([
//                'message' => 'Ouvidoria aberta com sucesso',
//                'docs' => [
//                        'ouvidoria' => $ouvidoriaInstance->toArray()
//                ]
//            ], 200);
//
//
//        }
//        catch (Exception $e){
//            dd($e->getMessage());
//        }
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
