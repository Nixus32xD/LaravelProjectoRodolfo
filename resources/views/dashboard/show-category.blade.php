@extends('layouts.app')

@section('main')


    <h1 class="__heading">Listado Categorias</h1>
    <div class="catalogo">

        @foreach ($categorias as $categoria)
            <a href="{{ route('category.edit', $categoria->id) }}">
                <div class="item">
                    <h3>Titulo: {{ $categoria->nombre }}</h3>

                    <a href="{{ route('category.edit', $categoria->id) }}" class="btn-edit">Editar</a>

                    <form action="{{ route('category.destroy', $categoria->id) }}" method="POST" class="form-delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </a>
        @endforeach
    </div>
@endsection
