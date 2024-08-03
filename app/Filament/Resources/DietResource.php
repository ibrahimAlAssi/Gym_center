<?php

namespace App\Filament\Resources;

use App\Domains\Club\Models\Diet;
use App\Filament\Resources\DietResource\Pages;
use App\Filament\Resources\DietResource\RelationManagers\FoodsRelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class DietResource extends Resource
{
    protected static ?string $model = Diet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->string(),

                Select::make('is_free')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('is_free')
                    ->state(function (Model $record): string {
                        return $record->is_free == 1 ? 'Yes' : 'No';
                    })
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Yes' => 'success',
                        'No' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FoodsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiets::route('/'),
            'create' => Pages\CreateDiet::route('/create'),
            'edit' => Pages\EditDiet::route('/{record}/edit'),
        ];
    }
}
