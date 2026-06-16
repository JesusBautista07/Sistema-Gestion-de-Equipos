<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo; 


class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           Equipo::create($request->all());
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
    public function edit(Request $request, Equipo $equipos)
    {
        return view('equipos.edit', compact('equipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipos)
    {
        $equipos->update($request->all());   
        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipos)
    {
        $equipos->delete(); 
        return redirect()->route('equipos.index');
    }
}
