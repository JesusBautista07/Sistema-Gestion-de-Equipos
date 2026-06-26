<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * MÓDULO: GESTIÓN DE SOLICITANTES
 * * DESCRIPCIÓN:
 * Este modelo representa la tabla 'solicitantes' en la base de datos. Mapea la información 
 * de las personas autorizadas para retirar equipos de la institución (Nombre, Documento, 
 * Correo y Tipo: Estudiante o Docente).
 * * ASPECTOS CLAVE DE INVESTIGACIÓN IMPLEMENTADOS:
 * 1. Definición de Atributos Seguros ($fillable): Permite la persistencia de datos de forma masiva, 
 * asegurando la integridad de los campos obligatorios solicitados en los formularios de registro.
 * 2. Relación Eloquent (hasMany): Resuelve la relación "Un solicitante puede realizar múltiples préstamos 
 * a lo largo del tiempo", manteniendo la trazabilidad histórica de las solicitudes del usuario.
 */
class Solicitante extends Model
{
    use HasFactory;

    // Campos habilitados para asignación masiva mediante el CRUD de solicitantes
    protected $fillable = [ 
        'nombre',    
        'documento',
        'correo',
        'tipo', // Valores permitidos: Estudiante o Docente
    ];

    /**
     * Relación Uno a Muchos (One-to-Many)
     * Un Solicitante puede tener un historial con múltiples registros de préstamos.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }    
}