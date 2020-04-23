<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;

class ResponderOuvidoria extends Mailable
{
    use Queueable, SerializesModels;

    private $mensagem = null;
    private $email = null;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($postData)
    {
        $postData = is_array($postData) ? (object) $postData : $postData;

        $this->mensagem = $postData->mensagem;
        $this->email = $postData->email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $this->subject('Resposta Ouvidoria - Unifametro');
//        $this->to($this->email);
//        $this->from('sistemas@unifametro.edu.br','Unifametro');

        json_encode(Log::info($this->mensagem));

        $this->markdown('emails.resposta-ouvidoria', [
            "mensagem" => $this->mensagem
        ]);
    }
}
