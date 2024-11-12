<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    public function getProducts()
{
    return $this->record->productos; // Devuelve todos los productos asociados a la categoría
}


    public function getProductCount()
    {
        return $this->record->productos()->count(); // Devuelve el número de productos asociados a la categoría
    }
    
    // Aquí puedes agregar otros métodos o propiedades según sea necesario
}
