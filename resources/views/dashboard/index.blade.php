@extends('layouts.app')

@section('main')
    <!-- Contenido principal del dashboard -->

    <div class="dashboard-menu">
        <div class="dashboard-welcome">
            ¡Bienvenido al Dashboard!
        </div>

        <ul>
            <li><a href="{{ route('dashboard.create-job') }}">Crear Trabajo</a></li>
            <li><a href="{{ route('dashboard.create-category') }}">Crear Categoría</a></li>
            <li><a href="{{ route('dashboard.show-jobs') }}">Ver Trabajos</a></li>
            <li><a href="{{ route('dashboard.show-category') }}">Ver Categorías</a></li>
        </ul>
    </div>

    <!-- Resto del contenido del dashboard -->
@endsection
