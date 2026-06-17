<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipo_id',
        'solicitante_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
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
