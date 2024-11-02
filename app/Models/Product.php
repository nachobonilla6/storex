<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';


    protected $fillable = [
        'name',
        'price',
        'size',
        'image_url',
        'description', // Agregar aquí
    ];

    // Si tienes alguna otra configuración o relación, puedes incluirla aquí
}


