@extends('layouts.app')

@section('main')
    <div class="form-container">
        <a href="{{ route('dashboard.show-category') }}" class="btn-back"> Volver</a>

        <h1 class="form-heading">Editar Categoria</h1>

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

        <form method="POST" action="{{ route('category.update', $categoria->id) }}" class="edit-job-form" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Utiliza el método PUT para la actualización --}}

            {{-- Resto del formulario --}} <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            </div>

            <button type="submit" class="btn-primary">Actualizar Categoria</button>

        </form>
    </div>
@endsection
