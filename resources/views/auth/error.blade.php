@extends('layouts.app')

@section('main')
    <div class="error-container">
        <h1 class="error-heading">Error</h1>
        <p class="error-message">Ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.</p>
        <a href="{{ route('pagina_principal') }}" class="error-link">Volver a la página principal</a>
    </div>
@endsection
