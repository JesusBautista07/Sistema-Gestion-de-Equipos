@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Editar Equipo</h2>
    <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror"
                    value="{{ old('codigo', $equipo->codigo) }}">
                @error('codigo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $equipo->nombre) }}">
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    <option value="Portátil" {{ old('categoria', $equipo->categoria) == 'Portátil' ? 'selected' : '' }}>Portátil</option>
                    <option value="Videobeam" {{ old('categoria', $equipo->categoria) == 'Videobeam' ? 'selected' : '' }}>Videobeam</option>
                    <option value="Cámara" {{ old('categoria', $equipo->categoria) == 'Cámara' ? 'selected' : '' }}>Cámara</option>
                    <option value="Tablet" {{ old('categoria', $equipo ->categoria) == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                </select>
                @error('categoria')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror"
                    value="{{ old('marca', $equipo->marca) }}">
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    <option value="Disponible" {{ old('estado', $equipo->estado) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Prestado" {{ old('estado', $equipo->estado) == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                    <option value="Mantenimiento" {{ old('estado', $equipo->estado) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="bi bi-save"></i> Actualizar
            </button>

        </form>
    </div>
</div>

@endsection