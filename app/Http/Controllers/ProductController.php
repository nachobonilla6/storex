<?php

namespace App\Http\Controllers;

use App\Models\Pokemon; // Mantén esto
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de la tabla 'products'
        $pokemons = Pokemon::all();

        // Pasar la variable a la vista 'welcome'
        return view('welcome', compact('pokemons'));
    }
}
