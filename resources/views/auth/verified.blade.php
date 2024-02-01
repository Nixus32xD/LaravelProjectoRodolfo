@extends('layouts.app')

@section('main')
    <div class="verification-container">
        <h1 class="verification-heading">Cuenta Verificada</h1>
        <p class="verification-message">
            ¡Felicidades! Tu cuenta ha sido verificada exitosamente.
        </p>
        <a href="{{ url('/dashboard') }}" class="verification-button">Ir a Dashboard</a>
    </div>
@endsection
