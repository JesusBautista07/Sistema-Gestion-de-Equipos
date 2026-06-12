<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Equipo', function (Blueprint $table) {
            $table->id();
            $table->integer('Codigo')->unique();
            $table->string('Nombre');   
            $table->string('Categoria');
            $table->string('Marca');
            $table->enum('Estado', ['Disponible', 'Prestado', 'Mantenimiento'])->default('Disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
