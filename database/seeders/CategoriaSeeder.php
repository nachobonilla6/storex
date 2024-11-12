<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            'Tenis',
            'Hombre',
            'Mujer',

        ];

        foreach ($categorias as $name) {
            Categoria::create(['name' => $name]);
        }
    }
}
