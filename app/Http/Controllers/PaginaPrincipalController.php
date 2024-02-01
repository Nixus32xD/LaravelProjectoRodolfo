<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Trabajo;
use Illuminate\Http\Request;

class PaginaPrincipalController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $trabajos = Trabajo::all();

        return view('index/pagina_principal', compact('categorias'));
    }

    public function showJobsFromCategory($id)
    {
        // Obtener todos los trabajos con la categoría deseada
        $trabajos =  Trabajo::where('categoria_id', $id)->get();

        return view('index.item',compact('trabajos'));
    }

    public function nosotros(){
        return view('index.nosotros');
    }
}
