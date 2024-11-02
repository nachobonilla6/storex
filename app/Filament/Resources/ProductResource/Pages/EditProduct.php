<?php
namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Name'),

            Forms\Components\TextInput::make('price')
                ->required()
                ->label('Price'),

            Forms\Components\TextInput::make('size')
                ->required()
                ->label('Size'),

            Forms\Components\TextInput::make('image_url')
                ->label('Image URL')
                ->required()
                ->afterStateUpdated(fn ($state) => $this->previewImage($state)),

            // Aquí se agrega el componente para la vista previa de la imagen
            Forms\Components\View::make('filament::components.image-preview')
                ->label('Image Preview')
                ->viewData(fn ($record) => [
                    'image_url' => $record->image_url,
                ]),
        ];
    }

    protected function previewImage($url)
    {
        // Actualiza el estado de la imagen aquí
        $this->form->getState()['image_url'] = $url;
    }
}
