<?php

namespace App\Filament\Resources\PlayerResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderDietsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderDiets';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('diet_id')
            ->columns([
                TextColumn::make('diet.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('player.name')
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
                //
            ])
            ->headerActions([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('status');
    }
}
