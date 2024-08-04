<?php

namespace App\Filament\Resources;

use App\Domains\Club\Models\Product;
use App\Filament\Resources\ProductResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->string(),
                TextInput::make('price')->required()->numeric()->minLength(0),
                TextInput::make('brand')->required()->string(),
                SpatieMediaLibraryFileUpload::make('products')
                    ->collection('products')
                    ->columnSpanFull()
                    ->rule([
                        'required',
                        'image',
                        'mimes:jpeg,png,jpg,gif,svg',
                        'max:2048', // Maximum file size in kilobytes
                    ],)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                SpatieMediaLibraryImageColumn::make('products')
                    ->collection('products')->toggleable()->label('image'),
                TextColumn::make('price')->sortable()->searchable(),
                TextColumn::make('brand')->sortable()->searchable(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
