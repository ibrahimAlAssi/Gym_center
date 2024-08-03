<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Domains\Plans\Models\Discount;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\DiscountResource\Pages;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('plan_id')
                    ->relationship('plan','name')
                    ->preload()
                    ->searchable()
                    ->required(),
                DatePicker::make('start_date')
                    ->format('Y-m-d')
                    ->after('now')
                    ->default(now())
                    ->required(),
                DatePicker::make('end_date')
                    ->format('Y-m-d')
                    ->after('start_date')
                    ->required(),
                TextInput::make('value')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(90)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('plan.name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('end_date')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('value')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
