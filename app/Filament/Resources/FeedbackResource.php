<?php

namespace App\Filament\Resources;

use App\Domains\Entities\Models\Feedback;
use App\Filament\Resources\FeedbackResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->state(function (Model $record): string {
                        return $record->player_id ? 'player' : 'coach';
                    }),
                TextColumn::make('name')
                    ->state(function (Model $record): string {
                        return $record->player_id ? $record->player?->name : $record->coach?->name;
                    }),
                TextColumn::make('message'),
                TextColumn::make('is_complaint')
                    ->state(function (Model $record): string {
                        return $record->is_complaint ? 'complaint' : 'suggestion';
                    })->searchable()->sortable()->label('Feedback Type'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListFeedback::route('/'),
            // 'create' => Pages\CreateFeedback::route('/create'),
            // 'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
