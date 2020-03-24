<?php

namespace Modules\Ouvidoria\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Ouvidoria\Entities\Ouvidoria;
use Illuminate\Support\Facades\Mail;

class OuvidoriaController extends Controller
{
    private $ouvidoria = null;

    public function __construct(Ouvidoria $ouvidoria){
        $this->ouvidoria = $ouvidoria;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('ouvidoria::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('ouvidoria::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        try {
            $ouvidoriaInstance = $this->ouvidoria->fill(array_merge(
                // $request->values,
                $request->post(),
                [
                    'protocolo' =>  md5(uniqid(""))
                ]
            ));
            $ouvidoriaInstance->save();
            if($ouvidoriaInstance){
                $contatoEmail = $ouvidoriaInstance->contato;
                $numeroProtocolo = $ouvidoriaInstance->protocolo;
                
                Mail::send('emails.confirmacao-ouvidoria', ['protocolo' => $numeroProtocolo], function ($message) use ($contatoEmail) {
                    $message->to($contatoEmail);
                    $message->from('sistemas@unifametro.edu.br','Unifametro');
                    $message->subject('Recebemos sua solicitação.');
                });

                return response()->json([
                    'message' => 'Ouvidoria criada com sucesso',
                    'docs' => [
                        'ouvidoria' => $ouvidoriaInstance->toArray()
                    ]
                ], 200);
            }

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro ao salvar a ouvidoria. Tente novamente',
                'error' => $e->getMessage()
            ], 500);
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('ouvidoria::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('ouvidoria::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
