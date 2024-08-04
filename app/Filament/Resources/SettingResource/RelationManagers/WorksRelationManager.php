<?php

namespace App\Filament\Resources\SettingResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WorksRelationManager extends RelationManager
{
    protected static string $relationship = 'works';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('day')
                    ->options([
                        'Sunday' => 'Sunday',
                        'Monday' => 'Monday',
                        'Tuesday' => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday' => 'Thursday',
                        'Friday' => 'Friday',
                        'Saturday' => 'Saturday',
                    ])
                    ->disabled()
                    ->required(),
                TextInput::make('man')
                    ->placeholder('7:00 AM - 01:00 PM')
                    // ->regex('/[0-9][0-9]:[0-9][0-9] (AM|PM) - [0-9][0-9]:[0-9][0-9] (AM|PM)/')
                    ->regex('/([0-9][0-9]:[0-9][0-9] (AM|PM) - [0-9][0-9]:[0-9][0-9] (AM|PM)|CLOSED)/i')

                    ->maxLength(255),

                TextInput::make('woman')
                    ->placeholder('7:00 AM - 01:00 PM')
                    ->regex('/([0-9][0-9]:[0-9][0-9] (AM|PM) - [0-9][0-9]:[0-9][0-9] (AM|PM)|CLOSED)/i')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('day')
            ->columns([
                TextColumn::make('day'),
                TextColumn::make('man'),
                TextColumn::make('woman'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
