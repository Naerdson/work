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

class AlertaSetorOuvidoria extends Mailable
{
    use Queueable, SerializesModels;

    public $ouvidoria;
    public $emailAlerta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ouvidoria, $emailAlerta)
    {
        $this->ouvidoria = $ouvidoria;
        $this->emailAlerta = $emailAlerta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //$this->subject('Alerta de recebimento de ouvidoria');
       // return $this->from('exemplo@exemplo.com')->view('emailtest');
       return $this->view('emails.alert.alertEmail');
    }
}
