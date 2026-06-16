@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Solicitantes</h2>
    <a href="{{ route('solicitantes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Solicitante
    </a>
</div>

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
        @foreach($solicitantes as $solicitante)
        <tr>
            <td>{{ $solicitante->nombre }}</td>
            <td>{{ $solicitante->documento }}</td>
            <td>{{ $solicitante->correo }}</td>
            <td>
                @if($solicitante->tipo == 'Estudiante')
                    <span class="badge bg-primary">Estudiante</span>
                @else
                    <span class="badge bg-info text-dark">Docente</span>
                @endif
            </td>
            <td>
                <a href="{{ route('solicitantes.edit', $solicitante->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <form action="{{ route('solicitantes.destroy', $solicitante->id) }}" method="POST" style="display:inline">
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