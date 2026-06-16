<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;

class SolicitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitantes = Solicitante::all();
        return view('solicitantes.index', compact('solicitantes'));

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
    public function store(Request $request, Solicitante $solicitantes)
    {
        Solicitante::create($request->all());
        return redirect()->route('solicitantes.index', compact('solicitantes'));
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
    public function edit(string $id)
    {
        return view('solicitantes.edit', compact('solicitantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitante $solicitantes)
    {
        $solicitantes->update($request->all());
        return redirect()->route('solicitantes.index', compact('solicitantes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitante $solicitantes)
    {
        $solicitantes->delete();
        return redirect()->route('solicitantes.index');
    }
}
