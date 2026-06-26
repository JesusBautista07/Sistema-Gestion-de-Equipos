<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MÓDULO: GESTIÓN DE EQUIPOS
 * * DESCRIPCIÓN:
 * Este modelo representa la tabla 'equipos' en la base de datos[cite: 27]. 
 * Se encarga de mapear los atributos de los dispositivos tecnológicos (Código, Nombre, Categoría, Marca y Estado) [cite: 7]
 * y define su comportamiento dentro del ORM Eloquent.
 * * ASPECTOS CLAVE DE INVESTIGACIÓN IMPLEMENTADOS:
 * 1. Asignación Masiva ($fillable): Protege la base de datos definiendo estrictamente qué campos pueden ser
 * insertados o actualizados mediante arreglos, evitando vulnerabilidades de seguridad (Mass Assignment).
 * 2. Relación Eloquent (hasMany): Implementa la relación "Un equipo puede tener muchos préstamos".
 * Esto permite rastrear el historial de préstamos asociados a un dispositivo específico.
 */
class Equipo extends Model
{
    use HasFactory;

    // Atributos que se pueden registrar de forma masiva en el CRUD [cite: 7]
    protected $fillable = [
        'codigo',
        'nombre',   
        'categoria',
        'marca',
        'estado', // Estados permitidos: Disponible, Prestado, Mantenimiento [cite: 8]
    ];

    /**
     * Relación Uno a Muchos (One-to-Many)
     * Un Equipo posee múltiples registros de préstamos a lo largo del tiempo.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }
}