@extends('layouts.app')

@section('main')
    <div class="form-container">
        <a href="{{ route('dashboard.index') }}" class="btn-back"> Volver</a>

        <h1 class="form-heading">Crear Categoria</h1>

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
        @endif

        <form method="POST" action="{{ route('dashboard.store-category') }}" class="store-job-form">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la categoria:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>

            <button type="submit" class="btn-primary">Crear Categoria</button>
        </form>
    </div>
@endsection
