@extends('layouts.app')

@section('main')
    <div class="verification-container">
        <h1 class="__heading">Verificación de Correo Electrónico</h1>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
            </div>
        @endif
        <p class="__text">Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico
            haciendo clic en el enlace que te hemos enviado.</p>
        <p class="__text">Si no has recibido el correo electrónico, te enviaremos otro.</p>


        <form method="POST" action="{{ route('verification.resend') }}" class="__resend-form">
            @csrf
            <button type="submit">Reenviar Correo de Verificación</button>
        </form>
        </p>
    </div>
@endsection
