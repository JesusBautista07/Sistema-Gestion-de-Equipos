@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Solicitantes</h2>
    <a href="{{ route('solicitantes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Solicitante
    </a>
</div>

{{-- Formulario de búsqueda --}}
<form method="GET" action="{{ route('solicitantes.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="busqueda" class="form-control" 
               placeholder="Buscar por nombre o documento..." 
               value="{{ $busqueda ?? '' }}">
        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i> Buscar
        </button>
        @if(!empty($busqueda))
            <a href="{{ route('solicitantes.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Limpiar
            </a>
        @endif
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($solicitante as $solicitantes)
        <tr>
            <td>{{ $solicitantes->nombre }}</td>
            <td>{{ $solicitantes->documento }}</td>
            <td>{{ $solicitantes->correo }}</td>
            <td>
                @if($solicitantes->tipo == 'Estudiante')
                    <span class="badge bg-primary">Estudiante</span>
                @else
                    <span class="badge bg-info text-dark">Docente</span>
                @endif
            </td>
            <td>
                <a href="{{ route('solicitantes.edit', $solicitantes->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <form action="{{ route('solicitantes.destroy', $solicitantes->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('¿Eliminar este solicitante?')">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection