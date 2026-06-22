<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\PrestamosController;
use App\Http\Controllers\SolicitantesController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/equipos', EquiposController::class);

Route::resource('/solicitantes', SolicitantesController::class); 

Route::resource('/prestamos', PrestamosController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');