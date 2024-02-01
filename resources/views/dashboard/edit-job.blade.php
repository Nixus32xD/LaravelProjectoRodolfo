@extends('layouts.app')

@section('main')
    <div class="form-container">
        <a href="{{ route('dashboard.show-jobs') }}" class="btn-back"> Volver</a>

        <h1 class="form-heading">Editar Trabajo</h1>

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

        <form method="POST" action="{{ route('job.update', $job->id) }}" class="edit-job-form" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Utiliza el método PUT para la actualización --}}

            {{-- Resto del formulario --}} <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $job->nombre) }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion', $job->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                @if ($job->imagen)
                    <img src="{{ asset($job->url) }}" alt="Imagen Actual" class="current-image">
                @endif
                <input type="file" id="file-input-image" name="imagen" accept="image/*">
                <label for="file-input-image">Seleccionar archivo</label>
            </div>

            <div class="form-group">
                <label for="usuario_id">Persona que carga la publicación:</label>
                <select id="usuario_id" name="usuario_id">
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" @if($job->usuario_id == $usuario->id) selected @endif>
                            {{ $usuario->nombre . ' ' . $usuario->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select id="categoria_id" name="categoria_id">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @if($job->categoria_id == $categoria->id) selected @endif>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="fecha">Fecha de Realización:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $job->fecha) }}">
            </div>

            <button type="submit" class="btn-primary">Actualizar Trabajo</button>

        </form>
    </div>
@endsection
