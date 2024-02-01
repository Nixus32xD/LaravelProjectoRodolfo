@extends('layouts.app')

@section('main')
    <!-- Sección principal -->
    <h1 class="__heading">Bienvenidos a Metalurgica Y Herreria Artistica</h1>
    <p class="__descripcion">Somos especialistas en metalurgia y soldadura artística. Contáctanos para hacer realidad tus
        ideas.</p>
@endsection


@section('section')
    @foreach ($categorias as $categoria)
        <a href="{{route('show-jobs-from-category', $categoria->id)}}">
            <div class="item">
                <h2>{{ $categoria->nombre }}</h2>
                @if ($categoria->trabajos->isNotEmpty())
                    <img src="{{ $categoria->trabajos->first()->url }}" alt="{{ $categoria->nombre }}">
                @endif

                <p>{{ $categoria->descripcion }}</p>
            </div>
        </a>
    @endforeach
@endsection
