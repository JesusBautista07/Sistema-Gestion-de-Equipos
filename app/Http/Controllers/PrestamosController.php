<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
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
        return view('prestamos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Prestamo $prestamos)
    {
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
