<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Especificar la tabla si no sigue la convención de nombres
    protected $table = 'products';

    // Si el campo 'id' es autoincremental, no es necesario agregarlo al array 'fillable'
    // Laravel lo gestionará automáticamente.

    // Definir los campos que son asignables en masa (no se incluye 'id' ya que es autoincremental)
    protected $fillable = [
        'name',
        'in_stock',
        'price',
        'size',
        'image_url',
        'description',
        'categoria_id',
    ];

    // Si tienes los campos 'created_at' y 'updated_at' y quieres que Laravel los maneje automáticamente,
    // puedes habilitar la siguiente propiedad (si no es el caso, puedes omitirla).
    public $timestamps = true;  // Esto es opcional si tienes los campos de fecha en la base de datos.

    // Relación con el modelo Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);  // Relación de 'pertenece a'
    }

    // Si deseas tratar el campo de 'precio' como float o el campo de 'cantidad en stock' como integer, puedes hacerlo
    // Forzando un casting a ciertos tipos.
    protected $casts = [
        'price' => 'float',
        'in_stock' => 'integer',
    ];
}
