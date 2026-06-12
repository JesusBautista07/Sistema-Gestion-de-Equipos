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
    Schema::create('Prestamo', function (Blueprint $table) {
        $table->id();
        
        $table->foreignId('Equipo_id')
              ->constrained('Equipo')
              ->onDelete('cascade');
              
        $table->foreignId('Solicitante_id')
              ->constrained('Solicitante')
              ->onDelete('cascade');

        $table->date('Fecha_prestamo');
        $table->date('Fecha_devolucion_esperada');
        $table->date('Fecha_devolucion_real')->nullable(); 

        $table->timestamps();
    });
}
};
