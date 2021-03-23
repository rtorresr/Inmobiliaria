<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Consulta extends Mailable
{
    use Queueable, SerializesModels;

    protected $correo, $nombre, $asunto, $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $nombre, $asunto, $mensaje)
    {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->asunto = $asunto;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->view('mails.consulta')
                ->subject("Consulta WEB NICS Inmobiliaria")
                ->with([
                    "correo" => $this->correo,
                    "nombre" => $this->nombre,
                    "asunto" => $this->asunto,
                    "mensaje" => $this->mensaje
                ]);
    }
}
