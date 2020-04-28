<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Log;
use StdClass;

class ResponderOuvidoria extends Mailable
{
    use Queueable, SerializesModels;

    private $data = null;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\StdClass $postData)
    {
        $this->data = $postData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $this->subject('Resposta Ouvidoria - Unifametro');
       $this->to($this->data->email);
       $this->from('sistemas@unifametro.edu.br', 'Ouvidoria Unifametro');       
       $this->markdown('emails.resposta-ouvidoria', [
           'data' => $this->data
       ]);
    }
}
