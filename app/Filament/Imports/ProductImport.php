<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        // Si el id está presente y quieres usarlo, puedes asignarlo de esta forma
        return new Product([
            'id' => $row['id'], // Solo asigna si el campo 'id' está presente en el CSV
            'name' => $row['name'],
            'in_stock' => $row['in_stock'],
            'price' => $row['price'],
            'size' => $row['size'],
            'image_url' => $row['image_url'],
            'description' => $row['description'],
            'categoria_id' => $row['categoria_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'in_stock' => 'required|integer',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'image_url' => 'required|url',
            'description' => 'required|string',
            'categoria_id' => 'required|integer',
        ];
    }
}
