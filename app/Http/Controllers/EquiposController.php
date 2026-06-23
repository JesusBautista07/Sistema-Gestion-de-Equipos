<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo; 
use Barryvdh\DomPDF\Facade\Pdf;


class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->input('busqueda');

        $equipo = Equipo::when($busqueda, function ($query, $busqueda) {
                        $query->where('codigo', 'like', "%$busqueda%")
                            ->orWhere('nombre', 'like', "%$busqueda%");
                    })
                    ->get();

        return view('equipos.index', compact('equipo', 'busqueda'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'codigo'    => 'required|unique:equipos,codigo',
            'nombre'    => 'required',
            'categoria' => 'required',
            'marca'     => 'required',
            'estado'    => 'required|in:Disponible,Prestado,Mantenimiento',
        ]);

        Equipo::create($request->all());

        return redirect()->route('equipos.index')
                        ->with('success', 'Equipo creado correctamente');
    }
    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete(); 
        return redirect()->route('equipos.index');
    }



    public function exportarPdf()
    {
        $equipos = Equipo::all();

        $pdf = Pdf::loadView('equipos.pdf', compact('equipos'));

        return $pdf->stream('reporte_equipos.pdf');
    }
}
