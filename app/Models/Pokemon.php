<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'products'; // Cambia 'pokemon' a 'products'

    // Define los campos que se pueden llenar masivamente
    protected $fillable = ['name', 'price', 'image_url', 'description', 'size'];
}
