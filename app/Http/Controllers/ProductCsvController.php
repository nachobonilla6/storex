<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductCsvController extends Controller
{
    public function importCsv(Request $request)
    {
        // Validación para asegurarnos de que se ha subido un archivo CSV
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:10240', // Puedes ajustar el tamaño y tipo de archivo
        ]);

        // Obtener el archivo CSV subido
        $file = $request->file('csv_file');
        
        // Leer el contenido del archivo CSV como un string
        $csvContent = file_get_contents($file); // O usar $file->get() si prefieres

        // Convertir el CSV a un array
        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        
        // Remover encabezados si existen (opcional)
        array_shift($rows); // Si tu CSV tiene una fila de encabezados, usa esto para eliminarla

        // Iterar sobre cada fila del CSV y guardar los productos en la base de datos
        foreach ($rows as $row) {
            if (count($row) < 7) continue; // Verificar que cada fila tenga al menos 7 columnas

            Product::create([
                'name' => $row[0],            // nombre
                'in_stock' => $row[1],        // cantidad en stock
                'price' => $row[2],           // precio
                'size' => $row[3],            // tamaño
                'image_url' => $row[4],       // URL de la imagen
                'description' => $row[5],     // descripción
                'categoria_id' => $row[6],    // ID de categoría
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Productos importados correctamente');
    }
}
