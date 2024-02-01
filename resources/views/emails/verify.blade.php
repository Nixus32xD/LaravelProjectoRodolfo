@component('mail::message')
    # Verificación de Dirección de Correo Electrónico

    ¡Gracias por registrarte! Antes de comenzar, necesitamos que verifiques tu dirección de correo electrónico.

    @component('mail::button', ['url' => $url])
        Verificar Correo Electrónico
    @endcomponent

    Si no creaste una cuenta, no se requiere ninguna acción adicional.

    Gracias, {{ config('app.name') }}
@endcomponent
