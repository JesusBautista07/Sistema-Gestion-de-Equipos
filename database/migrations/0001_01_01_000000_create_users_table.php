<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla 'equipos' y define sus columnas
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();                                                   // Llave primaria auto-incremental
            $table->string('codigo')->unique();                             // Identificador único del equipo (ej. serial)
            $table->string('nombre');                                       // Nombre o descripción del dispositivo
            $table->string('categoria');                                    // Tipo (Portátil, Videobeam, etc.)
            $table->string('marca');                                        // Fabricante del dispositivo
            $table->enum('estado', ['Disponible', 'Prestado', 'Mantenimiento'])->default('Disponible'); // Restricción de estados y valor inicial
            $table->timestamps();                                           // Columnas creados_en y actualizados_en
        });
    }

    // Revierte los cambios eliminando la tabla
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};