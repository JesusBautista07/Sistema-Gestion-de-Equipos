@extends('layouts.app')

@section('content')

<div class="text-center py-5">
    <i class="bi bi-laptop" style="font-size: 4rem;"></i>
    <h1 class="mt-3">Sistema de Gestión de Préstamo de Equipos</h1>
    <p class="lead text-muted">
        Administra equipos, solicitantes y préstamos de forma sencilla.
    </p>

    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg mt-3">
        <i class="bi bi-speedometer2"></i> Ir al Dashboard
    </a>
</div>

@endsection