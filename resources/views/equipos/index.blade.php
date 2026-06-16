@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Equipos</h2>
    <a href="{{ route('equipos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Equipo
    </a>
</div>

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
        @foreach($equipos as $equipo)
        <tr>
            <td>{{ $equipo->codigo }}</td>
            <td>{{ $equipo->nombre }}</td>
            <td>{{ $equipo->categoria }}</td>
            <td>{{ $equipo->marca }}</td>
            <td>
                {{-- Badge de color según estado --}}
                @if($equipo->estado == 'Disponible')
                    <span class="badge bg-success">Disponible</span>
                @elseif($equipo->estado == 'Prestado')
                    <span class="badge bg-warning text-dark">Prestado</span>
                @else
                    <span class="badge bg-danger">Mantenimiento</span>
                @endif
            </td>
            <td>
                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" style="display:inline">
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