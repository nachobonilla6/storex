<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $label = 'Pedidos';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('products')
                    ->multiple()
                    ->relationship('products', 'name')
                    ->label('Productos')
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->label('Estado'),
                Forms\Components\TextInput::make('tracking_id')
                    ->label('ID de Seguimiento'),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label('Fecha de Creación')
                    ->disabled(),
                Forms\Components\DateTimePicker::make('updated_at')
                    ->label('Fecha de Actualización')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                BadgeColumn::make('status')
                    ->label('Estado')
                    ->colors([
                        'primary' => 'pendiente',
                        'success' => 'completado',
                        'danger' => 'cancelado',
                    ]),
                TextColumn::make('tracking_id')->label('ID de Seguimiento'),
                TextColumn::make('created_at')->label('Fecha de Creación')->dateTime(),
                TextColumn::make('updated_at')->label('Fecha de Actualización')->dateTime(),
            ])
            ->filters([
                // Filtros si es necesario
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
