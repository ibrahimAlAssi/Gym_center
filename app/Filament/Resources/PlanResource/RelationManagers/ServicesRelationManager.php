<?php

namespace App\Filament\Resources\PlanResource\RelationManagers;

use App\Domains\Plans\Models\Service;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id')
                    ->label('name')
                    ->options(Service::all()->pluck('name', 'id'))
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('description')
                    ->readOnly(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\AttachAction::make()->preloadRecordSelect()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
