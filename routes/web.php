<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/equipos', EquiposController::class);
    Route::get('/equipos/pdf/exportar', [EquiposController::class, 'exportarPdf'])->name('equipos.pdf');

    Route::resource('/solicitantes', SolicitantesController::class);
    Route::get('/solicitantes/pdf/exportar', [SolicitantesController::class, 'exportarPdf'])->name('solicitantes.pdf');

    Route::resource('/prestamos', PrestamosController::class);
    Route::get('/prestamos/pdf/exportar', [PrestamosController::class, 'exportarPdf'])->name('prestamos.pdf');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';