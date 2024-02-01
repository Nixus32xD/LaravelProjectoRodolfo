@extends('layouts.app')

@section('main')
    <div class="form-container">
        <a href="{{ route('dashboard.index') }}" class="btn-back"> Volver</a>

        <h1 class="form-heading">Crear Trabajo</h1>

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

        <form method="POST" action="{{ route('dashboard.store-job') }}" class="create-job-form" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <input type="file" id="file-input-image" name="imagen" accept="image/*">
                <label for="file-input-image">Seleccionar archivo</label>
            </div>

            <div class="form-group">
                <label for="usuario_id">Persona que carga la publicacion:</label>
                <select id="usuario_id" name="usuario_id">

                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre . ' ' . $usuario->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select id="categoria_id" name="categoria_id">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha de Realización:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}">
            </div>

            <button type="submit" class="btn-primary">Crear Trabajo</button>
        </form>
    </div>
@endsection
