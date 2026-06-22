<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Prestamo;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDisponibles = Equipo::where('estado', 'Disponible')->count();
        $totalPrestados   = Equipo::where('estado', 'Prestado')->count();
        $totalPrestamos   = Prestamo::count();

        return view('dashboard', compact('totalDisponibles', 'totalPrestados', 'totalPrestamos'));
    }
}