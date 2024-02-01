<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Trabajo;
use App\Models\Categoria;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index');
    }

    public function showCreateJobForm()
    {
        $usuarios = User::all();
        $categorias = Categoria::all();

        return view('dashboard.create-job', [
            'usuarios' => $usuarios,
            'categorias' => $categorias
        ]);
    }


    public function storeJob(Request $request)
    {
        // Lógica para almacenar el trabajo en la base de datos
        // Utiliza $request para acceder a los datos del formulario
        // Validación de campos requeridos y tipo de dato correcto
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|max:4096',
            'usuario_id' => 'required',
            'categoria_id' => 'required',
            'fecha' => 'required|date'
        ]);

        if ($request->file('imagen')) {
            // Obtener la imagen relacionada con el campo "imagen" del formular
            $manager = new ImageManager(new Driver());

            // Trabajamos con la imagen
            $image = $request->file('imagen')->store('public/imagenes');
            $image_name = $request->file('imagen')->hashName();
            // Redimensionando la imagen
            $img = $manager->read($request->file('imagen'));
            $img = $img->resize(400, 400);

            $img->toAvif(100)->save(base_path('public/storage/imagenes/' . $image_name));
            $url = '/storage/imagenes/' . $image_name;


            // Crear un nuevo trabajo con los datos del formulario
            Trabajo::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'url' => $url,
                'imagen' => $image_name,
                'usuario_id' => $request->input('usuario_id'),
                'fecha' => $request->input('fecha'),
                'categoria_id' => $request->input('categoria_id'),
            ]);
        }


        // Después de almacenar el trabajo, puedes redirigir a donde desees
        return redirect()->route('dashboard.create-job')->with('status', 'Trabajo creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function showJobs()
    {
        $jobs = Trabajo::all();
        foreach ($jobs as $job) {
            $job->usuario_id = User::find($job->usuario_id);
            $job->categoria_id = Categoria::find($job->categoria_id);
        }
        return view('dashboard.showjobs', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editJob(string $id)
    {
        $job = Trabajo::findOrFail($id);
        $categorias = Categoria::all();
        $usuarios = User::all();
        // $job->usuario_id = User::findOrFail($job->usuario_id);
        // $job->categoria_id = Categoria::findOrFail($job->categoria_id);

        // Renderizar el formulario de edición con los detalles del trabajo
        return view('dashboard.edit-job', compact('job', 'categorias', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateJob(Request $request, $id)
    {
        // Validación de campos requeridos y tipo de dato correcto
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'image|max:4096',  // Permitir que la imagen sea opcional en la actualización
            'usuario_id' => 'required',
            'categoria_id' => 'required',
            'fecha' => 'required|date'
        ]);

        // Obtener el trabajo existente
        $job = Trabajo::findOrFail($id);

        // Eliminar la imagen actual si existe
        if ($request->hasFile('imagen')  && !is_null($job->imagen)) {
            Storage::delete('/public/imagenes/' . $job->imagen);
        }

        // Trabajar con la nueva imagen si se proporciona
        if ($request->hasFile('imagen')) {

            $manager = new ImageManager(new Driver());
            $image = $request->file('imagen')->store('public/imagenes');
            $image_name = $request->file('imagen')->hashName();
            // Redimensionando la imagen
            $img = $manager->read($request->file('imagen'));
            $img = $img->resize(400, 400);

            $img->toAvif(100)->save(base_path('public/storage/imagenes/' . $image_name));
            $url = '/storage/imagenes/' . $image_name;

            // Actualizar campos de la base de datos incluyendo la nueva imagen
            $job->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'url' => $url,
                'imagen' => $image_name,
                'usuario_id' => $request->input('usuario_id'),
                'fecha' => $request->input('fecha'),
                'categoria_id' => $request->input('categoria_id'),
            ]);
        } else {
            // Si no se proporciona una nueva imagen, actualizar otros campos excepto la imagen
            $job->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'usuario_id' => $request->input('usuario_id'),
                'fecha' => $request->input('fecha'),
                'categoria_id' => $request->input('categoria_id'),
            ]);
        }

        // Redirigir a donde desees después de la actualización
        return redirect()->route('job.edit', compact('id'))->with('status', 'Trabajo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyJobs($id)
    {
        $job = Trabajo::findOrFail($id);

        if ($job->imagen) {
            Storage::delete('public/imagenes/' . $job->imagen);
        }

        // Eliminar el trabajo de la base de datos
        $job->delete();

        return redirect()->route('dashboard.index')->with('status', 'Trabajo eliminado correctamente.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function showCreateCategoryForm()
    {
        return view('dashboard.create-category');
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:categorias|max:100',
            'descripcion' => 'required|string'
        ]);

        Categoria::create([
            "nombre" => $request->input("nombre"),
            "descripcion" => $request->input("descripcion")
        ]);

        // Después de almacenar el trabajo, puedes redirigir a donde desees
        return redirect()->route('dashboard.create-category')->with('status', 'Categoria creada correctamente.');
    }

    public function showCategory()
    {
        $categorias = Categoria::all();
        return view('dashboard.show-category', compact('categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCategory($id)
    {
        $categoria = Categoria::findOrFail($id);

        // Renderizar el formulario de edición con los detalles del trabajo
        return view('dashboard.edit-category', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCategory(Request $request, $id)
    {
        // Validación de campos requeridos y tipo de dato correcto
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string'
        ]);

        // Obtener el trabajo existente
        $categoria = Categoria::findOrFail($id);

        // Trabajar con la nueva imagen si se proporciona
        $categoria->update([
            'nombre' => $request->input('nombre'),
            "descripcion" => $request->input("descripcion")
        ]);

        // Redirigir a donde desees después de la actualización
        return redirect()->route('category.edit', compact('id'))->with('status', 'Categoria actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyCategory($id)
    {
        $categoria = Categoria::findOrFail($id);


        // Eliminar el trabajo de la base de datos
        $categoria->delete();

        return redirect()->route('dashboard.show-category')->with('status', 'Categoria eliminada correctamente.');
    }
}
