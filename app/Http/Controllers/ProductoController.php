<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Rating;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Producto::all();
        return view('products_temp.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products_temp.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {
            // Validación de los datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'presentacion' => 'required|string|max:255',
                'componentes' => 'required|string',
                'descripcion' => 'required|string',
                'indicaciones' => 'required|string',
                'contraindicaciones' => 'required|string',
                'stock' => 'required|integer',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
    
            //crear una nueva instancia de Productos
            $product = new Producto();
            $product->nombre = $request->nombre;
            $product->presentacion = $request->presentacion;
            $product->componentes = $request->componentes;
            $product->descripcion = $request->descripcion;
            $product->indicaciones = $request->indicaciones;
            $product->contraindicaciones = $request->contraindicaciones;
            $product->stock = $request->stock;
            $product->precio_compra = $request->precio_compra;
            $product->precio_venta = $request->precio_venta;

            // Manejar la carga de la imagen si se proporciona
            if ($request->hasFile('imagen')) {
                $fileName = time(). '.'. $request->imagen->extension();
                $request->imagen->move(public_path('images'), $fileName);
                $product->imagen = $fileName;
            }

            // Guardar el producto
            $product->save();
    
            // Redirigir después de guardar el producto
            return redirect()->route('adminProducts')->with('success', 'Producto creado exitosamente.');
        }
    }

    /**
     * Display the specified resource.*/
    public function show($slug)
    {
        $product = Producto::where('slug', '=', $slug)->firstOrFail();
        
        return view('products_temp.show', compact('product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Producto::find($id);
        return view('products_temp.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'presentacion' => 'required|string|max:255',
            'componentes' => 'required|string',
            'descripcion' => 'required|string',
            'indicaciones' => 'required|string',
            'contraindicaciones' => 'required|string',
            'stock' => 'required|integer',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'imagen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        // actualizar el producto
        $product = Producto::find($id);
        $product->nombre = $request->input('nombre');
        $product->presentacion = $request->input('presentacion');
        $product->componentes = $request->input('componentes');
        $product->descripcion = $request->input('descripcion');
        $product->indicaciones = $request->input('indicaciones');
        $product->contraindicaciones = $request->input('contraindicaciones');
        $product->stock = $request->input('stock');
        $product->precio_compra = $request->input('precio_compra');
        $product->precio_venta = $request->input('precio_venta');

        // Manejar la carga de la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $fileName = time(). '.'. $request->imagen->extension();
            $request->imagen->move(public_path('images'), $fileName);
            $product->imagen = $fileName;
        }

        $product->save();

        // Redirigir después de actualizar el producto
        return redirect()->route('adminProducts')->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Producto::find($id);
        if ($product) {
            Storage::delete('images/'.$product->imagen);
            $product->delete();
        }
        return redirect()->route('adminProducts')->with('success', 'Producto eliminado exitosamente.');
    }

    public function adminProducts()
    {
        $products = Producto::all();
        return view('products_temp.adminProducts', compact('products'));
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
