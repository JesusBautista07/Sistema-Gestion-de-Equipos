<?php

namespace App\Mail;

use App\Models\Prestamo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * CLASE MAILABLE: PrestamoRegistrado
 * * DESCRIPCIÓN:
 * Esta clase representa la estructura del correo electrónico que se envía de forma 
 * automatizada al solicitante. Encapsula los datos de la transacción y define la 
 * plantilla visual que se renderizará en el buzón de entrada.
 */
class PrestamoRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    // Propiedad pública para que los datos del préstamo estén disponibles automáticamente en la vista Blade
    public $prestamo;

    /**
     * Crea una nueva instancia del mensaje inyectando la información del préstamo.
     */
    public function __construct(Prestamo $prestamo)
    {
        $this->prestamo = $prestamo;
    }

    /**
     * Construye el mensaje configurando el asunto institucional y la plantilla HTML.
     */
    public function build()
    {
        return $this->subject('Confirmación de Préstamo de Equipo') // Asunto del correo electrónico
                    ->view('emails.prestamo_registrado');           // Ruta de la vista: resources/views/emails/prestamo_registrado.blade.php
    }
}