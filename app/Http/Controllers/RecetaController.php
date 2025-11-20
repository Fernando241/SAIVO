<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'ingredientes' => 'required|string|max:255',
            'preparacion' => 'required|string',
            'uso' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // Crear la receta
        $receta = new Receta();
        $receta->titulo = $request->titulo;
        $receta->ingredientes = $request->ingredientes;
        $receta->preparacion = $request->preparacion;
        $receta->uso = $request->uso;

        if ($request->hasFile('imagen')) {
            $fileName = time(). '.'. $request->imagen->extension();
            $request->imagen->move(public_path('images'), $fileName);
            $receta->imagen = $fileName;
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
            'ingredientes' => 'required|string|max:255',
            'preparacion' => 'required|string',
            'uso' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',	
        ]);

        // Buscar la receta y actualizar los datos
        $receta = Receta::find($id);
        $receta->titulo = $request->input('titulo');
        $receta->ingredientes = $request->input('ingredientes');
        $receta->preparacion = $request->input('preparacion');
        $receta->uso = $request->input('uso');

        // manejar la carga de la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            
            // Solo borrar si realmente existe
            if ($receta->imagen) {
                $oldPath = public_path('images/' . $receta->imagen);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $fileName = time(). '.'. $request->imagen->extension();
            $request->imagen->move(public_path('images'), $fileName);
            $receta->imagen = $fileName;
        }

        $receta->save();

        // Redireccionar a la lista de recetas
        return redirect()->route('recetas.index')->with('success', 'Receta actualizada correctamente');
    }

    public function destroy($id)
    {
        $receta = Receta::find($id);
        if ($receta) {
            Storage::delete('images/'.$receta->imagen);
            $receta->delete();
        }
        // Redireccionar a la lista de recetas
        return redirect()->route('recetas.index')->with('success', 'Receta eliminada correctamente.');
    }
}
