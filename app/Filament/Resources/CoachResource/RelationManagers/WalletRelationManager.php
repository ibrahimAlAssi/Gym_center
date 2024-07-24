<?php

namespace App\Filament\Resources\CoachResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class WalletRelationManager extends RelationManager
{
    protected static string $relationship = 'wallet';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('available')
                    ->required()
                    ->integer()
                    ->maxLength(255),
                TextInput::make('pending')
                    ->required()
                    ->integer()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('available')
            ->columns([
                TextColumn::make('available'),
                TextColumn::make('pending'),
                TextColumn::make('total')
                    ->state(function (Model $record): float {
                        return $record->available + $record->pending;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
