<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function index(){
        // Mostrar lista de recetas en la vista recetas.index
        $recetas = Receta::all();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        return view('recetas.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'ingredientes' => 'required|string',
            'preparacion' => 'required|string',
            'uso' => 'required|string',
        ]);

        // Crear la receta
        $receta = new Receta();
        $receta->titulo = $request->input('titulo');
        $receta->ingredientes = $request->input('ingredientes');
        $receta->preparacion = $request->input('preparacion');
        $receta->uso = $request->input('uso');

        if ($request->hasFile('imagen')) {
            $imageName = time(). '.'. $request->imagen->extension();
            $request->imagen->move(public_path('images'), $imageName);
            $receta->imagen = $imageName;
        }

        $receta->save();

        // Redireccionar a la lista de recetas
        return redirect()->route('recetas.index')->with('success', 'Receta creada correctamente');
    }

    public function edit($id)
    {
        $receta = Receta::find($id);
        return view('recetas.edit', compact('receta'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'ingredientes' => 'required|string',
            'preparacion' => 'required|string',
            'uso' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',	
        ]);

        // Buscar la receta y actualizar los datos
        $receta = Receta::find($id);
        $receta->titulo = $request->input('titulo');
        $receta->ingredientes = $request->input('ingredientes');
        $receta->preparacion = $request->input('preparacion');
        $receta->uso = $request->input('uso');

        // manejar la carga de la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            if ($receta->imagen) {
                unlink(public_path('images/'. $receta->imagen));
            }
            $fileName = time(). '.'. $request->imagen->extension();
            $request->imagen->move(public_path('images'), $fileName);
            $receta->imagen = $fileName;
        }

        $receta->save();

        // Redireccionar a la lista de recetas
        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente');
    }
}
