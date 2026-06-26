<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Ruta pública de bienvenida / index institucional
Route::get('/', function () {
    return view('welcome');
})->name('home');

// GRUPO DE RUTAS PROTEGIDAS: Solo accesibles para administradores autenticados
Route::middleware('auth')->group(function () {

    // Ruta del Panel de Control principal (Métricas)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Módulo Equipos: CRUD automático + Ruta personalizada para reporte PDF
    Route::resource('/equipos', EquiposController::class);
    Route::get('/equipos/pdf/exportar', [EquiposController::class, 'exportarPdf'])->name('equipos.pdf');

    // Módulo Solicitantes: CRUD automático + Ruta personalizada para reporte PDF
    Route::resource('/solicitantes', SolicitantesController::class);
    Route::get('/solicitantes/pdf/exportar', [SolicitantesController::class, 'exportarPdf'])->name('solicitantes.pdf');

    // Módulo Préstamos: CRUD automático + Ruta personalizada para reporte PDF
    Route::resource('/prestamos', PrestamosController::class);
    Route::get('/prestamos/pdf/exportar', [PrestamosController::class, 'exportarPdf'])->name('prestamos.pdf');

    // Módulo de Perfil: Edición, actualización y borrado seguro de la cuenta del administrador
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Carga las rutas de autenticación nativas de Laravel Breeze (Login, Registro, Logout)
require __DIR__.'/auth.php';