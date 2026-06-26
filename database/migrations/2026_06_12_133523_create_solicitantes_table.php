<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla 'solicitantes' y define sus columnas
    public function up(): void
    {
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->id();                                   // Llave primaria auto-incremental
            $table->string('nombre');                       // Nombre completo del solicitante
            $table->string('documento')->unique();          // Identificación única (evita duplicados)
            $table->string('correo')->unique();             // Correo electrónico único
            $table->enum('tipo', ['Estudiante', 'Docente']); // Restricción de roles permitidos
            $table->timestamps();                           // Columnas creados_en y actualizados_en
        });
    }

    // Revierte los cambios eliminando la tabla
    public function down(): void
    {
        Schema::dropIfExists('solicitantes');
    }
};