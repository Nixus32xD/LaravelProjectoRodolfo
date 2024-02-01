@extends('layouts.app')

@section('main')
    <div class="password-reset-container">
        <h2>Restablecer Contraseña</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <button type="submit">Enviar Enlace de Restablecimiento</button>
        </form>
    </div>
@endsection
