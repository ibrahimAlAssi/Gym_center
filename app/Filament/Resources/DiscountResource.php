<?php

namespace App\Filament\Resources;

use App\Domains\Plans\Models\Discount;
use App\Filament\Resources\DiscountResource\Pages;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('plan_id')
                    ->relationship('plan', 'name')
                    ->preload()
                    ->searchable()
                    ->unique(ignoreRecord:true)
                    ->required(),
                DatePicker::make('start_date')
                    ->format('Y-m-d')
                    ->after(now()->subDay())
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
                TextColumn::make('plan.cost')
                ->label('Cost')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->date('Y-m-d')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('end_date')
                    ->date('Y-m-d')
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
            ])->defaultSort('id','desc');
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
