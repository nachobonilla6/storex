<?php



namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

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
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('imagePreview', $state)),

            Forms\Components\Html::make('image_preview')
                ->label('Image Preview')
                ->html(fn ($get) => $get('imagePreview') ? '<div style="margin-top: 10px;"><img src="' . $get('imagePreview') . '" alt="Image Preview" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px; border-radius: 4px;"></div>' : '<p style="margin-top: 10px; color: #888;">No image to preview</p>'),
        ];
    }

    protected function getActions(): array
    {
        return [
            Actions\Action::make('createNewProduct')
                ->label('New Product')
                ->url(route('filament.admin.resources.products.create')) // Asegúrate de que esta ruta sea la correcta
                ->color('success'), // Cambia el color según lo que necesites
        ];
    }
}
