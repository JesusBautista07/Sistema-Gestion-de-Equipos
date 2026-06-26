<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MÓDULO: REGISTRO DE PRÉSTAMOS Y DEVOLUCIONES
 * * DESCRIPCIÓN:
 * Este modelo mapea la tabla 'prestamos' en la base de datos. Es la entidad transaccional 
 * central del sistema, encargada de vincular un equipo tecnológico con un solicitante, 
 * además de gestionar los flujos de tiempo (fechas de salida, esperada y real de retorno).
 * * ASPECTOS CLAVE DE INVESTIGACIÓN IMPLEMENTADOS:
 * 1. Relación Inversa (belongsTo - Equipo): Conecta cada préstamo con el equipo específico que fue 
 * solicitado, permitiendo acceder a los atributos del dispositivo (como código o marca).
 * 2. Relación Inversa (belongsTo - Solicitante): Vincula el préstamo con la persona (estudiante o docente) 
 * que realiza la solicitud para identificar la responsabilidad del equipo.
 */
class Prestamo extends Model
{
    use HasFactory;

    // Campos habilitados para asignación masiva al crear o actualizar transacciones
    protected $fillable = [
        'equipo_id',                 // Llave foránea que conecta con la tabla equipos
        'solicitante_id',            // Llave foránea que conecta con la tabla solicitantes
        'fecha_prestamo',            // Fecha en la que se entrega el equipo
        'fecha_devolucion_esperada', // Fecha límite de entrega según el flujo institucional
        'fecha_devolucion_real',     // Fecha real en la que el usuario devuelve el dispositivo
    ];

    /**
     * Relación de Pertenencia (Belongs To)
     * Muchos registros de préstamos pertenecen a un único 'Equipo'.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    /**
     * Relación de Pertenencia (Belongs To)
     * Muchos registros de préstamos pertenecen a un único 'Solicitante'.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}