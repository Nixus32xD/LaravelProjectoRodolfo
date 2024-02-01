@extends('layouts.app')

@section('main')
    <div class="form-container">
        <h1 class="contact-heading">Contáctanos</h1>

        @if ($errors->any())
            <ul class="error-message">
                @foreach ($errors->all() as $error)
                    <li>* {{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @elseif (session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif
        <div class="whatsapp-contact">
            <i class="fa-brands fa-whatsapp fa-lg" style="color: #63E6BE;"></i>
            <p> <span>+54 9 261 578-9013</span></p>

        </div>
        <div class="whatsapp-contact">
            <i class="fa-brands fa-whatsapp fa-lg" style="color: #63E6BE;"></i>
            <p> <span>+54 9 261 525-5278</span></p>
        </div>
        <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre completo:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="mensaje">Deja tu mensaje:</label>
                <textarea id="mensaje" name="mensaje">{{ old('mensaje') }}</textarea>
            </div>

            <button type="submit" class="btn-primary">Enviar Mensaje</button>
        </form>
    </div>
@endsection
