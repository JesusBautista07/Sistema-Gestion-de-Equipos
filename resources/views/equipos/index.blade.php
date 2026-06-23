@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Equipos</h2>
    <a href="{{ route('equipos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Equipo
    </a>
    <a href="{{ route('equipos.pdf') }}" class="btn btn-outline-danger">
        <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
    </a>
</div>

{{-- Formulario de búsqueda --}}
<form method="GET" action="{{ route('equipos.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="busqueda" class="form-control" 
               placeholder="Buscar por código o nombre..." 
               value="{{ $busqueda ?? '' }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Buscar
        </button>
        @if(!empty($busqueda))
            <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Limpiar
            </a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($equipo as $equipos)
        <tr>
            <td>{{ $equipos->codigo }}</td>
            <td>{{ $equipos->nombre }}</td>
            <td>{{ $equipos->categoria }}</td>
            <td>{{ $equipos->marca }}</td>
            <td>
                @if($equipos->estado == 'Disponible')
                    <span class="badge bg-success">Disponible</span>
                @elseif($equipos->estado == 'Prestado')
                    <span class="badge bg-warning text-dark">Prestado</span>
                @else
                    <span class="badge bg-danger">Mantenimiento</span>
                @endif
            </td>
            <td>
                <a href="{{ route('equipos.edit', $equipos->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <form action="{{ route('equipos.destroy', $equipos->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar este equipo?')">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection