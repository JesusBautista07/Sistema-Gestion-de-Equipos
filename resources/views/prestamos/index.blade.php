@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Préstamos</h2>
    <a href="{{ route('prestamos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Préstamo
    </a>
</div>

{{-- Formulario de búsqueda --}}
<form method="GET" action="{{ route('prestamos.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="busqueda" class="form-control" 
               placeholder="Buscar por equipo o solicitante..." 
               value="{{ $busqueda ?? '' }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Buscar
        </button>
        @if(!empty($busqueda))
            <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Limpiar
            </a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Equipo</th>
            <th>Solicitante</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Esperada</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prestamo as $prestamos)
        <tr>
            <td>{{ $prestamos->equipo->nombre }}</td>
            <td>{{ $prestamos->solicitante->nombre }}</td>
            <td>{{ $prestamos->fecha_prestamo }}</td>
            <td>{{ $prestamos->fecha_devolucion_esperada }}</td>
            <td>{{ $prestamos->fecha_devolucion_real ?? 'Pendiente' }}</td>
            <td>
                @if($prestamos->fecha_devolucion_real)
                    <span class="badge bg-success">Devuelto</span>
                @else
                    <span class="badge bg-warning text-dark">Pendiente</span>
                @endif
            </td>
            <td>
                @if(!$prestamos->fecha_devolucion_real)
                    <a href="{{ route('prestamos.edit', $prestamos->id) }}" class="btn btn-sm btn-success">
                        <i class="bi bi-arrow-return-left"></i> Devolver
                    </a>
                @endif
                <form action="{{ route('prestamos.destroy', $prestamos->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar este préstamo?')">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection