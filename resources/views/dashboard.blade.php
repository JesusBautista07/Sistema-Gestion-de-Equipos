@extends('layouts.app')

@section('content')

    <h2 class="mb-4">Dashboard</h2>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Equipos Disponibles</h5>
                    <p class="display-4">{{ $totalDisponibles }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Equipos Prestados</h5>
                    <p class="display-4">{{ $totalPrestados }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5 class="card-title">Préstamos Realizados</h5>
                    <p class="display-4">{{ $totalPrestamos }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Accesos rápidos --}}
    <h4 class="mb-3">Accesos Rápidos</h4>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="{{ route('equipos.index') }}" class="btn btn-outline-dark w-100 py-3">
                <i class="bi bi-laptop"></i> Ver Equipos
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('equipos.create') }}" class="btn btn-outline-dark w-100 py-3">
                <i class="bi bi-plus-circle"></i> Nuevo Equipo
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('solicitantes.create') }}" class="btn btn-outline-dark w-100 py-3">
                <i class="bi bi-person-plus"></i> Nuevo Solicitante
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="{{ route('prestamos.create') }}" class="btn btn-outline-dark w-100 py-3">
                <i class="bi bi-journal-plus"></i> Nuevo Préstamo
            </a>
        </div>

    </div>

@endsection