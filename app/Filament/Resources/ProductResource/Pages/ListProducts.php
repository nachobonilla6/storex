<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Imports\ProductImport; // Importador de productos
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    // Configuración de las acciones en el encabezado
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            // Acción personalizada para importar CSV
            Actions\Action::make('importCsv')
                ->label('Importar CSV') // Etiqueta del botón
                ->color('primary') // Color del botón
                ->modalHeading('Importar productos desde CSV') // Título de la modal
                ->modalSubheading('Selecciona un archivo CSV para importar productos.') // Subtítulo de la modal
                ->modalButton('Importar') // Texto del botón dentro de la modal
                ->form([
                    // Campo para cargar el archivo CSV
                    FileUpload::make('csv_file')
                        ->label('Archivo CSV') // Nombre del campo
                        ->required() // Hace el campo obligatorio
                        ->acceptedFileTypes(['text/csv', 'application/csv', 'text/plain']) // Acepta solo archivos CSV
                ])
                ->action(function ($data) {
                    if (isset($data['csv_file'])) {
                        try {
                            // Verificar si el archivo cargado es una instancia de UploadedFile
                            if ($data['csv_file'] instanceof UploadedFile) {
                                // Obtener el archivo subido
                                /** @var UploadedFile $file */
                                $file = $data['csv_file'];

                                // Almacenar el archivo en el almacenamiento local
                                $path = $file->storeAs('import', $file->getClientOriginalName(), 'local');

                                // Obtener la ruta completa del archivo almacenado
                                $filePath = storage_path('app/' . $path);

                                // Verificar si el archivo existe
                                if (!file_exists($filePath)) {
                                    throw new \Exception("El archivo CSV no se encontró en la ruta: $filePath");
                                }

                                // Usar Laravel Excel para importar el archivo CSV
                                Excel::import(new ProductImport, $filePath);

                                // Notificación de éxito
                                Notification::make()
                                    ->title('Importación exitosa')
                                    ->success()
                                    ->body('Los productos se han importado correctamente.')
                                    ->send();
                            } else {
                                throw new \Exception("El archivo cargado no es un archivo válido.");
                            }
                        } catch (\Exception $e) {
                            // Notificación de error
                            Notification::make()
                                ->title('Error al importar')
                                ->danger()
                                ->body('Hubo un error durante la importación: ' . $e->getMessage())
                                ->send();
                        }
                    }
                }),
        ];
    }

    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }

    protected function afterCreate(): void
    {
        $this->redirect($this->getResource()::getUrl('index'));
    }
}
