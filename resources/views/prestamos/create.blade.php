@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Nuevo Préstamo</h2>
    <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('prestamos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Equipo</label>
                <select name="equipo_id" class="form-select @error('equipo_id') is-invalid @enderror">
                    <option value="">-- Seleccione un equipo --</option>
                    @foreach($equipo as $equipos)
                        <option value="{{ $equipos->id }}" {{ old('equipo_id') == $equipos->id ? 'selected' : '' }}>
                            {{ $equipos->codigo }} - {{ $equipos->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('equipo_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Solicitante</label>
                <select name="solicitante_id" class="form-select @error('solicitante_id') is-invalid @enderror">
                    <option value="">-- Seleccione un solicitante --</option>
                    @foreach($solicitante as $solicitantes)
                        <option value="{{ $solicitantes->id }}" {{ old('solicitante_id') == $solicitantes->id ? 'selected' : '' }}>
                            {{ $solicitantes->nombre }} - {{ $solicitantes->documento }}
                        </option>
                    @endforeach
                </select>
                @error('solicitante_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Préstamo</label>
                <input type="date" name="fecha_prestamo" 
                    class="form-control @error('fecha_prestamo') is-invalid @enderror"
                    value="{{ old('fecha_prestamo') }}">
                @error('fecha_prestamo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha Esperada de Devolución</label>
                <input type="date" name="fecha_devolucion_esperada"
                    class="form-control @error('fecha_devolucion_esperada') is-invalid @enderror"
                    value="{{ old('fecha_devolucion_esperada') }}">
                @error('fecha_devolucion_esperada')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Registrar Préstamo
            </button>

        </form>
    </div>
</div>

@endsection