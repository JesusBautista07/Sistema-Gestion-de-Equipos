<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use Illuminate\Http\Request;

class PrestamosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Prestamo::all();
        return view('prestamos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipos = Equipo::where('estado', 'Disponible')->get();
        $solicitantes = Solicitante::all();
        return view('prestamos.create', compact('equipos', 'solicitantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Prestamo $prestamos)
    {

        $request->validate([
        'equipo_id'                => 'required|exists:equipos,id',
        'solicitante_id'           => 'required|exists:solicitantes,id',
        'fecha_prestamo'           => 'required|date',
        'fecha_devolucion_esperada'=> 'required|date|after:fecha_prestamo',
        ]);

        Prestamo::create($request->all());
        return redirect()->route('prestamos.index', compact('prestamos'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestamo $prestamos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestamo $prestamos)
    {
        return view('prestamos.edit', compact('prestamos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestamo $prestamos)
    {

        $request->validate([
        'fecha_devolucion_real' => 'required|date|after:fecha_prestamo',
        ]);

        $prestamos->update($request->all());
        return redirect()->route('prestamos.index', compact('prestamos'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestamo $prestamos)
    {
        $prestamos->delete();
        return redirect()->route('prestamos.index');
    }
}
