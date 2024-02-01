@extends('layouts.app')

@section('main')

    <h1 class="__heading">Listado de Trabajos</h1>
    <div class="catalogo">
        @foreach ($jobs as $job)
            <a href="{{ route('job.edit', $job->id) }}">
                <div class="item">
                    <h3>Titulo: {{ $job->nombre }}</h3>
                    <p>Descripcion: {{ $job->descripcion }}</p>
                    <p>Categoria: {{ $job->categoria_id->nombre }}</p>
                    <img src="{{ $job->url }}" alt="Imagen del trabajo" />
                    <p>Persona que Cargo la publicacion: {{ $job->usuario_id->nombre . ' ' . $job->usuario_id->apellido }}
                    </p>
                    <a href="{{ route('job.edit', $job->id) }}" class="btn-edit">Editar</a>

                    <form action="{{ route('job.destroy', $job->id) }}" method="POST" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </a>
        @endforeach
    </div>
@endsection
