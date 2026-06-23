<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;
use Barryvdh\DomPDF\Facade\Pdf;


class SolicitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $solicitante = Solicitante::when($busqueda, function ($query, $busqueda) {
                            $query->where('nombre', 'like', "%$busqueda%")
                                ->orWhere('documento', 'like', "%$busqueda%");
                        })
                        ->get();

        return view('solicitantes.index', compact('solicitante', 'busqueda'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('solicitantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Solicitante $solicitante)
    {

        $request->validate([
        'nombre'    => 'required',
        'documento' => 'required|unique:solicitantes,documento',
        'correo'    => 'required|email|unique:solicitantes,correo',
        'tipo'      => 'required|in:Estudiante,Docente',
        ]);

        Solicitante::create($request->all());
        return redirect()->route('solicitantes.index', compact('solicitante'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solicitante $solicitante)
    {
        return view('solicitantes.edit', compact('solicitante'));
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitante $solicitante)
    {
        $solicitante->delete();
        return redirect()->route('solicitantes.index');
    }

    public function exportarPdf()
    {
        $solicitantes = Solicitante::all();

        $pdf = Pdf::loadView('solicitantes.pdf', compact('solicitantes'));

        return $pdf->stream('reporte_solicitantes.pdf');
    }
}
