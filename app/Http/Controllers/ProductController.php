<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $productos = Product::all();

        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Pasar las variables a la vista 'welcome'
        return view('welcome', compact('productos', 'categorias'));
    }

    public function showByCategory($categoria_id)
    {
        // Obtener los productos por categoría
        $productos = Product::where('categoria_id', $categoria_id)->get();

        // Pasar los productos a la vista 'filament.productos.index'
        return view('filament.productos.index', compact('productos')); 
    }
}
