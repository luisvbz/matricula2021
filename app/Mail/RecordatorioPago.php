<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecordatorioPago extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $meses;
    public $padre;
    public $alumno;

    public function __construct($alumno, $padre, $meses)
    {
        $this->alumno = $alumno;
        $this->padre = $padre;
        $this->meses = $meses;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.recordatorio-pago')->subject('Recordatorio de Pago');
    }
}
