<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ButtonAction;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    protected static ?string $label = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nombre'),
                Forms\Components\TextInput::make('in_stock')->required()->label('Disponible'),
                Forms\Components\TextInput::make('price')->required()->label('Precio'),
                Select::make('size')
                    ->label('Tamaño')
                    ->options([
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                        '28' => '28',
                        '30' => '30',
                        '32' => '32',
                        '34' => '34',
                        '36' => '36',
                        '38' => '38',
                        '40' => '40',
                        '42' => '42',
                        '43' => '43',
                        '44' => '44',
                        '45' => '45',
                        '46' => '46',
                        'X' => 'X',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('image_url')->required()->label('URL de la imagen'),
                Forms\Components\Textarea::make('description')->required()->label('Descripción')->rows(3),
                Select::make('categoria_id')->label('Categoría')->relationship('categoria', 'nombre')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')->label('Imagen')->disk('public')->placeholder('no-image.png')->width(70)->height(70),
                Tables\Columns\TextColumn::make('name')->label('Nombre')->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Precio (₡)')->sortable(),
                Tables\Columns\TextColumn::make('size')->label('Tamaño')->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')->label('Categoría'),
                Tables\Columns\TextColumn::make('in_stock')->label('Stock'),
                Tables\Columns\TextColumn::make('updated_at')->label('Actualizado el')->sortable(),
            ])
            ->filters([
                // Filtros si es necesario
            ])
            ->actions([
                ButtonAction::make('edit')
                    ->label('Eliminar')
                    ->modalHeading('Confirmación de eliminación de producto')
                    ->modalSubheading('¿Estás seguro de que deseas eliminar este producto?')
                    ->modalButton('Eliminar')
                    ->successNotificationMessage('Producto eliminado con éxito.'),
            ])
            ->bulkActions([
                // Acción en masa para eliminar productos seleccionados
                BulkAction::make('deleteSelected')
                    ->label('Eliminar productos seleccionados')
                    ->action(function ($records) {
                        // Eliminamos los productos seleccionados
                        foreach ($records as $record) {
                            $record->delete();
                        }

                        // Notificación de éxito
                        notification()->success('Productos eliminados correctamente');
                    })
                    ->modalHeading('Confirmación de eliminación de productos')
                    ->modalSubheading('¿Estás seguro de que deseas eliminar estos productos?')
                    ->modalButton('Eliminar')
                    ->successNotificationMessage('Productos eliminados con éxito.'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getActions(): array
    {
        return [
            ButtonAction::make('importCsv')
                ->label('Importar CSV')
                ->action('importCsv')
                ->modalHeading('Importar productos desde CSV')
                ->modalSubheading('Selecciona un archivo CSV para importar productos.')
                ->modalButton('Importar')
                ->form([
                    Forms\Components\FileUpload::make('csv_file')
                        ->label('Archivo CSV')
                        ->required()
                        ->acceptedFileTypes(['text/csv', 'text/plain'])
                ])
                ->successNotificationMessage('Productos importados con éxito.'),
        ];
    }

    public static function importCsv($data)
    {
        $file = $data['csv_file']; // El archivo CSV
        $path = $file->store('temp'); // Guardamos el archivo en la carpeta temporal
        $filePath = storage_path('app/' . $path); // Ruta del archivo
    
        // Abrimos y leemos el archivo CSV
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Saltamos la primera fila si tiene encabezados
            fgetcsv($handle);
    
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                // Verificamos si el CSV tiene 7 columnas
                if (count($row) == 7) {
                    Product::create([
                        'name' => $row[0],
                        'in_stock' => $row[1],
                        'price' => $row[2],
                        'size' => $row[3],
                        'image_url' => $row[4],
                        'description' => $row[5],
                        'categoria_id' => $row[6],
                    ]);
                }
            }
            fclose($handle); // Cerramos el archivo después de procesarlo
        }
    
        // Eliminamos el archivo temporal
        unlink($filePath);
    }
}
