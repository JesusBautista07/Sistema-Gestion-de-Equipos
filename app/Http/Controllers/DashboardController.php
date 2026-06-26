<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Prestamo;
use Illuminate\Http\Request;

/**
 * CONTROLADOR: DashboardController
 * * DESCRIPCIÓN:
 * Controlador analítico encargado de la pantalla principal de la aplicación.
 * Recopila y procesa en tiempo real las métricas e indicadores de rendimiento (KPIs)
 * del estado del inventario y el volumen histórico de transacciones para su despliegue
 * en los paneles estadísticos visuales (Cards) del Dashboard.
 */
class DashboardController extends Controller
{
    /**
     * Procesa y calcula las métricas globales del sistema.
     * * REQUERIMIENTO COMPLETO: Retorna los contadores de equipos disponibles, prestados y total de transacciones.
     */
    public function index()
    {
        // REQUERIMIENTO 1: Ejecuta una consulta agregada para contar los equipos listos para préstamo
        $totalDisponibles = Equipo::where('estado', 'Disponible')->count();

        // REQUERIMIENTO 2: Cuenta los dispositivos que se encuentran actualmente en poder de un solicitante
        $totalPrestados   = Equipo::where('estado', 'Prestado')->count();

        // REQUERIMIENTO 3: Calcula el histórico total de transacciones de préstamo registradas
        $totalPrestamos   = Prestamo::count();

        // Envía las variables consolidadas a la vista 'dashboard.blade.php' mediante compact()
        return view('dashboard', compact('totalDisponibles', 'totalPrestados', 'totalPrestamos'));
    }
}