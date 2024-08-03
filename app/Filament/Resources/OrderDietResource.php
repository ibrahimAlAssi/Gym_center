<?php

namespace App\Filament\Resources;

use App\Domains\Club\Models\OrderDiet;
use App\Filament\Resources\OrderDietResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OrderDietResource extends Resource
{
    protected static ?string $model = OrderDiet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('player_id')
                    ->relationship('player', 'name')
                    ->disabled(),

                Select::make('diet_id')
                    ->relationship('diet', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                TextInput::make('description')->readOnly(),
                TextInput::make('weight')->readOnly(),
                TextInput::make('length')->readOnly(),
                TextInput::make('status')->readOnly(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('player.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('player.birthday')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('diet.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('weight')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('length')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                IconColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                TernaryFilter::make('status')->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderDiets::route('/'),
            'create' => Pages\CreateOrderDiet::route('/create'),
            'edit' => Pages\EditOrderDiet::route('/{record}/edit'),
        ];
    }
}
