@extends('layouts.app') <!-- Asegúrate de tener un layout que incluya las secciones necesarias -->

@section('main')
    <div class="reset-container">

        <h1 class="reset-heading">Restablecer Contraseña</h1>

        @if ($errors->any())
            <ul class="error-message">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="reset-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-primary">Restablecer Contraseña</button>
        </form>

    </div>
@endsection
