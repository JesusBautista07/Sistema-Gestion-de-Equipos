@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Registrar Devolución</h2>
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">

        {{-- Información del préstamo --}}
        <div class="alert alert-info">
            <p><strong>Equipo:</strong> {{ $prestamo->equipo->nombre }}</p>
            <p><strong>Solicitante:</strong> {{ $prestamo->solicitante->nombre }}</p>
            <p><strong>Fecha Préstamo:</strong> {{ $prestamo->fecha_prestamo }}</p>
            <p class="mb-0"><strong>Fecha Esperada:</strong> {{ $prestamo->fecha_devolucion_esperada }}</p>
        </div>

        <form action="{{ route('prestamos.update', $prestamo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Fecha Real de Devolución</label>
                <input type="date" name="fecha_devolucion_real"
                    class="form-control @error('fecha_devolucion_real') is-invalid @enderror"
                    value="{{ old('fecha_devolucion_real') }}">
                @error('fecha_devolucion_real')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-arrow-return-left"></i> Confirmar Devolución
            </button>

        </form>
    </div>
</div>

@endsection