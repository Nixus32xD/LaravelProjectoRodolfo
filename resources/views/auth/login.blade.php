@extends('layouts.app')

@section('main')
    <!-- Sección principal -->
    <div class="login-container">
        <h1 class="__heading">Iniciar Sesión</h1>

        <!-- Mostrar errores -->
        @if ($errors->has('email'))
            <div class="error-message">
                {{ $errors->first('email') }}
            </div>
        @endif
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <div class="check">
                    <label for="remember" class="ml-2 text-gray-700 text-sm">Recuérdame</label>
                    <input type="checkbox" id="remember" name="remember" class="form-checkbox h-4 w-4 text-blue-500">
                </div>
            </div>

            <button type="submit" class="btn-primary">Iniciar Sesión</button>
        </form>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
        @endif

        <a href="{{ route('register') }}" class="create-account">¿No tienes una cuenta? Crea una aquí.</a>

    </div>
@endsection
