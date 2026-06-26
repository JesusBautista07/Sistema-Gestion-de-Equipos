<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * MÓDULO: SEGURIDAD Y AUTENTICACIÓN
 * * DESCRIPCIÓN:
 * Este modelo extiende 'Authenticatable' y representa la tabla 'users' en la base de datos.
 * Es el encargado de gestionar las credenciales de los usuarios administradores del sistema,
 * permitiendo restringir el acceso a los CRUDs de equipos, solicitantes y préstamos.
 * * ASPECTOS CLAVE DE INVESTIGACIÓN IMPLEMENTADOS:
 * 1. Laravel Breeze / Autenticación: Implementa el núcleo de autenticación nativo para proteger el sistema.
 * 2. Atributos Ocultos ($hidden): Protege datos sensibles como contraseñas y tokens de sesión para que no 
 * sean expuestos en las respuestas HTTP o serializaciones JSON.
 * 3. Casteo de Atributos (casts): Asegura que la contraseña siempre se almacene de forma segura usando 
 * un algoritmo de hashing asíncrono y convierte las fechas de verificación a objetos DateTime nativos.
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Campos permitidos para el registro de nuevos usuarios administradores
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Atributos que se excluyen automáticamente al consultar o serializar el modelo
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Configuración de Conversión de Tipos (Casting)
     * Define cómo se deben tratar y transformar los datos al interactuar con la base de datos.
     * * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Conversión automática a objeto de fecha
            'password' => 'hashed',            // Encriptación automática de contraseñas (Bcrypt/Argon2)
        ];
    }
}