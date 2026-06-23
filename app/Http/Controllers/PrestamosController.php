<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $prestamo = Prestamo::with('equipo', 'solicitante')
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
    
    
    public function create()
    {
        $equipo = Equipo::where('estado', 'Disponible')->get();
        $solicitante = Solicitante::all();
        return view('prestamos.create', compact('equipo', 'solicitante'));
    }

    

    public function store(Request $request, Prestamo $prestamo)
    {

        $request->validate([
        'equipo_id'                => 'required|exists:equipos,id',
        'solicitante_id'           => 'required|exists:solicitantes,id',
        'fecha_prestamo'           => 'required|date',
        'fecha_devolucion_esperada'=> 'required|date|after:fecha_prestamo',
        ]);

        Prestamo::create($request->all());
        return redirect()->route('prestamos.index', compact('prestamo'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamo)
    {
        return view('prestamos.edit', compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamo)
    {

        $request->validate([
        'fecha_devolucion_real' => 'required|date|after:fecha_prestamo',
        ]);

        $prestamo->update($request->all());
        return redirect()->route('prestamos.index', compact('prestamo'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return redirect()->route('prestamos.index');
    }

    public function exportarPdf()
    {
        $prestamos = Prestamo::with('equipo', 'solicitante')->get();

        $pdf = Pdf::loadView('prestamos.pdf', compact('prestamos'));

        return $pdf->stream('reporte_prestamos.pdf');
    }
    
}
