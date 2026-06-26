<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\PrestamoRegistrado;
use Illuminate\Support\Facades\Mail;

/**
 * CONTROLADOR: PrestamosController
 * * DESCRIPCIÓN:
 * Controlador transaccional del sistema. Gestiona el ciclo de vida de los préstamos 
 * y devoluciones de equipos. Automatiza la actualización de estados del inventario,
 * implementa filtros dinámicos con relaciones cruzadas, despacha notificaciones por 
 * correo electrónico y genera reportes en PDF.
 */
class PrestamosController extends Controller
{
    /**
     * Muestra el histórico de préstamos utilizando optimización de consultas (Eager Loading)
     * y búsquedas condicionales a través de relaciones Eloquent.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        // INVESTIGACIÓN APLICADA: 'with()' reduce el problema de consultas N+1 (Eager Loading)
        $prestamo = Prestamo::with('equipo', 'solicitante')
                        // Búsqueda avanzada usando Query Builder sobre tablas relacionadas
                        ->when($busqueda, function ($query, $busqueda) {
                            $query->whereHas('equipo', function ($q) use ($busqueda) {
                                        $q->where('nombre', 'like', "%$busqueda%");
                                    })
                                    ->orWhereHas('solicitante', function ($q) use ($busqueda) {
                                        $q->where('nombre', 'like', "%$busqueda%");
                                    });
                        })
                        ->get();

        return view('prestamos.index', compact('prestamo', 'busqueda'));
    }
    
    /**
     * Muestra el formulario de registro de préstamos.
     * Filtra el inventario para asegurar que solo se puedan seleccionar equipos con estado 'Disponible'.
     */
    public function create()
    {
        $equipo = Equipo::where('estado', 'Disponible')->get();
        $solicitante = Solicitante::all();
        return view('prestamos.create', compact('equipo', 'solicitante'));
    }

    /**
     * Registra una nueva transacción de préstamo en el sistema.
     * * REQUERIMIENTO COMPLETO: Cambia automáticamente el estado del equipo a 'Prestado'
     * * PUNTO EXTRA: Envía una notificación por correo electrónico al solicitante.
     */
    public function store(Request $request)
    {
        // Validaciones lógicas: 'after:fecha_prestamo' evita inconsistencias de tiempo
        $request->validate([
            'equipo_id'                 => 'required|exists:equipos,id',
            'solicitante_id'            => 'required|exists:solicitantes,id',
            'fecha_prestamo'            => 'required|date',
            'fecha_devolucion_esperada' => 'required|date|after:fecha_prestamo',
        ]);

        // Crea el registro del préstamo
        $prestamo = Prestamo::create($request->all());

        // LÓGICA AUTOMATIZADA: Cambia el estado del equipo seleccionado a 'Prestado'
        $equipo = Equipo::find($request->equipo_id);
        $equipo->estado = 'Prestado';
        $equipo->save();

        // PUNTO EXTRA IMPLEMENTADO: Envío asíncrono de correo electrónico mediante Mailable
        Mail::to($prestamo->solicitante->correo)->send(new PrestamoRegistrado($prestamo));

        return redirect()->route('prestamos.index')
                        ->with('success', 'Préstamo registrado correctamente');
    }

    public function show(Prestamo $prestamo)
    {
        //
    }

    public function edit(Prestamo $prestamo)
    {
        return view('prestamos.edit', compact('prestamo'));
    }

    /**
     * Procesa la actualización del préstamo (Gestión de Devoluciones).
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $request->validate([
            'fecha_devolucion_real' => 'required|date|after:fecha_prestamo',
        ]);

        // 1. Se actualiza el préstamo con la fecha_devolucion_real
        $prestamo->update($request->all());

        // 2. REQUERIMIENTO #4 AUTOMATIZADO: El equipo vuelve a quedar 'Disponible'
        $equipo = $prestamo->equipo; // Usamos la relación Eloquent que creaste
        $equipo->estado = 'Disponible';
        $equipo->save();

        return redirect()->route('prestamos.index');
    }
    /**
     * Elimina una transacción de préstamo del registro histórico.
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos.index');
    }

    /**
     * PUNTO EXTRA: Exportación de reportes de préstamos a PDF.
     */
    public function exportarPdf()
    {
        $prestamos = Prestamo::with('equipo', 'solicitante')->get();

        $pdf = Pdf::loadView('prestamos.pdf', compact('prestamos'));

        return $pdf->stream('reporte_prestamos.pdf');
    }
}