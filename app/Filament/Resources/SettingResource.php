<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Domains\Club\Models\Gym;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SettingResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Filament\Resources\SettingResource\RelationManagers\WorksRelationManager;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class SettingResource extends Resource
{
    protected static ?string $model = Gym::class;
        protected static ?string $modelLabel = 'Settings';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->string(),
                TextInput::make('latitude')
                ->required()
                ->string(),
                TextInput::make('longitude')
                ->required()
                ->string(),
                Textarea::make('description')
                ->required()
                ->rows(4)
                ->string(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->sortable()
                ->toggleable()
                ->searchable(),
                TextColumn::make('latitude')
                ->sortable()
                ->toggleable()
                ->searchable(),
                TextColumn::make('longitude')
                ->sortable()
                ->toggleable()
                ->searchable(),
                TextColumn::make('description')
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
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            WorksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
