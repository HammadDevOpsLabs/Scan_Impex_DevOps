<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\ProductResource\RelationManagers\ItemsRelationManager;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductRelationManager::class,
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_number')->label(__('Number'))->required()->disabled(),
                Select::make('status')->label(__("Status"))->required()
                    ->options(function () {
                        return [
                            'pending' => __("Pending"),
                            'in-progress' => __("in progress"),
                            'canceled' => __("canceled"),
                            'delivered' => __("delivered"),
                        ];
                    })->preload()->filled(),
                Select::make('user_id')->label(__("User"))->required()
                    ->options(function () {
                        return User::all()->pluck('name', 'id');
                    })->preload()->filled()->disabled(),
                Forms\Components\TextInput::make('total_amount')->label(__('Total amount'))->required()->disabled(),


            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->label(__("Number"))->sortable()->searchable(),
                TextColumn::make('User.name')->label(__("User"))->sortable()->searchable(),
                TextColumn::make('status')->label(__("Order status"))->sortable()->searchable(),
                TextColumn::make('payment')->label(__("Payment type"))->sortable()->searchable(),
                TextColumn::make('total_amount')->label(__("Total amount"))->sortable()->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
