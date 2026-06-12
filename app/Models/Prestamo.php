<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'Equipo_id',
        'Solicitante_id',
        'Fecha_prestamo',
        'Fecha_devolucion_esperada',
        'Fecha_devolucion_real',
    ];
    public function Equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function Solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
