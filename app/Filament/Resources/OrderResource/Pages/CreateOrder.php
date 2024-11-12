<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('order_number')
                ->required()
                ->label('Número de Pedido'),

            Forms\Components\Select::make('products')
                ->multiple()
                ->relationship('products', 'name')
                ->label('Productos')
                ->required(),

            Forms\Components\TextInput::make('default_price')
                ->required()
                ->label('Precio por Defecto'),

            // Otros campos de la orden pueden ir aquí
        ];
    }
}
