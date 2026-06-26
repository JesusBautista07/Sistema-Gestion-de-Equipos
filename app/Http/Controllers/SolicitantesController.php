<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * CONTROLADOR: SolicitantesController
 * * DESCRIPCIÓN:
 * Administra el ciclo de vida (CRUD) de la comunidad académica habilitada para
 * retirar insumos (Estudiantes y Docentes). Controla la restricción de datos únicos,
 * realiza filtrados condicionales y automatiza la generación de PDF del padrón de usuarios.
 */
class SolicitantesController extends Controller
{
    /**
     * Muestra la lista de solicitantes registrados con soporte para búsquedas en tiempo real.
     * * INVESTIGACIÓN IMPLEMENTADA: Filtro avanzado con Query Builder por texto coincidente.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        // Evalúa condicionalmente si el usuario interactuó con el input de búsqueda
        $solicitante = Solicitante::when($busqueda, function ($query, $busqueda) {
                            $query->where('nombre', 'like', "%$busqueda%")
                                  ->orWhere('documento', 'like', "%$busqueda%");
                        })
                        ->get();

        return view('solicitantes.index', compact('solicitante', 'busqueda'));
    }

    /**
     * Devuelve la vista del formulario para registrar nuevos usuarios.
     */
    public function create()
    {
        return view('solicitantes.create');
    }

    /**
     * Valida y persiste un nuevo solicitante en la base de datos.
     * * INTEGRIDAD DE DATOS: Asegura correos válidos y restringe duplicados en documento y email.
     */
    public function store(Request $request, Solicitante $solicitante)
    {
        $request->validate([
        'nombre'    => 'required',
        'documento' => 'required|unique:solicitantes,documento', // Evita registros dobles de cédulas/TI
        'correo'    => 'required|email|unique:solicitantes,correo',  // Valida sintaxis de email y unicidad
        'tipo'      => 'required|in:Estudiante,Docente',          // Restringe los roles a los permitidos
        ]);

        // Crea el registro usando asignación masiva segura
        Solicitante::create($request->all());
        return redirect()->route('solicitantes.index', compact('solicitante'));
    }

    /**
     * Endpoint para visualización detallada (Omitido para este diseño).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra la pantalla de modificación inyectando el Modelo correspondiente.
     */
    public function edit(Solicitante $solicitante)
    {
        return view('solicitantes.edit', compact('solicitante'));
    }

    /**
     * Actualiza la información del usuario en la base de datos.
     * * NOTA TÉCNICA: Ignora la llave primaria actual en la validación 'unique' para permitir guardar cambios sin conflictos.
     */
    public function update(Request $request, Solicitante $solicitante)
    {
        $request->validate([
        'nombre'    => 'required',
        'documento' => 'required|unique:solicitantes,documento,' .$solicitante->id,
        'correo'    => 'required|email|unique:solicitantes,correo,' .$solicitante->id,
        'tipo'      => 'required|in:Estudiante,Docente',
        ]);

        $solicitante->update($request->all());
        return redirect()->route('solicitantes.index', compact('solicitante'));
    }

    /**
     * Remueve el registro del solicitante de la base de datos.
     */
    public function destroy(Solicitante $solicitante)
    {
        $solicitante->delete();
        return redirect()->route('solicitantes.index');
    }

    /**
     * Generación del padrón o reporte consolidado de solicitantes en formato PDF.
     */
    public function exportarPdf()
    {
        $solicitantes = Solicitante::all();

        $pdf = Pdf::loadView('solicitantes.pdf', compact('solicitantes'));

        return $pdf->stream('reporte_solicitantes.pdf');
    }
}