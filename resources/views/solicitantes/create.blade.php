@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Nuevo Solicitante</h2>
    <a href="{{ route('solicitantes.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('solicitantes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Documento</label>
                <input type="text" name="documento" class="form-control @error('documento') is-invalid @enderror"
                    value="{{ old('documento') }}">
                @error('documento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror"
                    value="{{ old('correo') }}">
                @error('correo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    <option value="Estudiante" {{ old('tipo') == 'Estudiante' ? 'selected' : '' }}>Estudiante</option>
                    <option value="Docente" {{ old('tipo') == 'Docente' ? 'selected' : '' }}>Docente</option>
                </select>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Guardar
            </button>

        </form>
    </div>
</div>

@endsection