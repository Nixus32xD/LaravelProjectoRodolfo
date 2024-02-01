@extends('layouts.app')


@section('section')
    @foreach ($trabajos as $trabajo)
        {{-- <a href="{{ route('show-jobs-from-category', $categoria->id) }}"> --}}
        <div class="item">
            <h2>{{ $trabajo->nombre }}</h2>

            <img src="{{ $trabajo->url }}" alt="{{ $trabajo->categoria->nombre }}">


            <p>Descripción: {{ $trabajo->descripcion }}</p>
        </div>
        </a>
    @endforeach
@endsection
