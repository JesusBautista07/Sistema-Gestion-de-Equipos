<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo; 
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * CONTROLADOR: EquiposController
 * * DESCRIPCIÓN:
 * Centraliza la lógica de negocio para el CRUD de dispositivos tecnológicos. 
 * Maneja el almacenamiento, edición, eliminación, filtrado por búsquedas dinámicas 
 * y la exportación de reportes institucionales en formato PDF.
 */
class EquiposController extends Controller
{
    /**
     * Muestra el listado de equipos con soporte para búsquedas dinámicas.
     * * INVESTIGACIÓN IMPLEMENTADA: Uso de Query Builder condicional (`when`).
     */
    public function index(Request $request)
    {
        // Captura el término ingresado en el input de búsqueda
        $busqueda = $request->input('busqueda');

        // Ejecuta la consulta aplicando filtros solo si el usuario escribió algo
        $equipo = Equipo::when($busqueda, function ($query, $busqueda) {
                        $query->where('codigo', 'like', "%$busqueda%")
                              ->orWhere('nombre', 'like', "%$busqueda%");
                    })
                    ->get();

        return view('equipos.index', compact('equipo', 'busqueda'));
    }

    /**
     * Muestra el formulario de creación de equipos.
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Almacena un nuevo equipo aplicando reglas estrictas de validación.
     * * INVESTIGACIÓN IMPLEMENTADA: Validaciones de seguridad en backend.
     */
    public function store(Request $request)
    {
        // Validaciones requeridas para garantizar la integridad de los datos
        $request->validate([
            'codigo'    => 'required|unique:equipos,codigo', // Código único obligatorio
            'nombre'    => 'required',
            'categoria' => 'required',
            'marca'     => 'required',
            'estado'    => 'required|in:Disponible,Prestado,Mantenimiento', // Restricción de estados permitidos
        ]);

        // Inserción masiva segura gracias al $fillable definido en el modelo
        Equipo::create($request->all());

        return redirect()->route('equipos.index')
                        ->with('success', 'Equipo creado correctamente');
    }

    /**
     * Actualiza los datos de un equipo existente.
     * * NOTA: Omite el código propio al validar la unicidad para permitir la edición.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'codigo'    => 'required|unique:equipos,codigo,' . $equipo->id,
            'nombre'    => 'required',
            'categoria' => 'required',
            'marca'     => 'required',
            'estado'    => 'required|in:Disponible,Prestado,Mantenimiento',
        ]);

        $equipo->update($request->all());
        return redirect()->route('equipos.index');
    }

    /**
     * Visualización específica de un recurso (No requerida para este CRUD).
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un equipo, inyectando el Modelo automáticamente.
     */
    public function edit(Request $request, Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Elimina físicamente un registro de equipo de la base de datos.
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete(); 
        return redirect()->route('equipos.index');
    }

    /**
     * PUNTO EXTRA: Generación de Reportes PDF.
     * Convierte la colección completa de equipos a una vista y la renderiza en un archivo descargable.
     */
    public function exportarPdf()
    {
        // Recupera todos los equipos del inventario
        $equipos = Equipo::all();

        // Carga la vista blade destinada a la estructura del PDF
        $pdf = Pdf::loadView('equipos.pdf', compact('equipos'));

        // Transmite el PDF directamente al navegador para su visualización o descarga
        return $pdf->stream('reporte_equipos.pdf');
    }
}