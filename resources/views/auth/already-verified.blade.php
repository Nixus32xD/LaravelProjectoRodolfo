@extends('layouts.app')

@section('main')
    <div class="verified-container">
        <h1 class="verified-heading">¡Cuenta Verificada!</h1>
        <p class="verified-message">Tu cuenta ya ha sido verificada. Ahora puedes acceder al contenido exclusivo.</p>
        <a href="{{ route('pagina_principal') }}" class="verified-link">Volver a la página principal</a>
    </div>
@endsection
