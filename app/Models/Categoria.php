<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación con los productos
    public function productos()
    {
        return $this->hasMany(Product::class);
    }

    // Método para obtener la cantidad de productos
    public function cantidadProductos()
    {
        return $this->productos()->count(); // Cuenta los productos relacionados
    }
}
