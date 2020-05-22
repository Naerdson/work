<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Log;
use StdClass;

class ResponderOuvidoria extends Mailable
{
    use Queueable, SerializesModels;

    private $mensagem;
    private $ouvidoria;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ouvidoria, $dataEmail)
    {
        $this->ouvidoria = $ouvidoria;
        $this->mensagem = $dataEmail;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $this->subject('Resposta Ouvidoria - Unifametro');
       $this->to($this->ouvidoria->contato);
       $this->from('sistemas@unifametro.edu.br', 'Ouvidoria Unifametro');
       $this->markdown('emails.resposta-ouvidoria', [
           'ouvidoria' => $this->ouvidoria,
           'mensagem' => $this->mensagem,
           'usuario' => Auth::user()
       ]);
    }
}
