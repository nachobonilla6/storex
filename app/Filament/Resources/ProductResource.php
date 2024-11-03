<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
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
                ->required()
                ->label('Image URL'),

            Forms\Components\Textarea::make('description') // Agregar el campo de descripción
                ->required()
                ->label('Description')
                ->rows(3), // Puedes ajustar el número de filas según sea necesario
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image')
                    ->disk('public')
                    ->placeholder('no-image.png')
                    ->width(50)
                    ->height(50)
                    ->extraAttributes(fn ($record) => [
                        'x-on:click' => 'openModal("' . $record->image_url . '")',
                        'style' => 'cursor: pointer;',
                    ]),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable(),

                Tables\Columns\TextColumn::make('size')
                    ->label('Size')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated At')
                ->sortable(),
            ])
            ->filters([
                // Define any filters you want here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make() // Agregar acción de eliminación
                    ->label('Delete')
                    ->modalHeading('Delete Product Confirmation')
                    ->modalSubheading('Are you sure you want to delete this product?')
                    ->modalButton('Delete')
                    ->successNotificationMessage('Product deleted successfully.'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Permitir eliminación múltiple
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // Define any relationships here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
