<?php

namespace App\Filament\Resources;

use App\Domains\Entities\Models\Feedback;
use App\Filament\Resources\FeedbackResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
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
                TextColumn::make('role')
                    ->state(function (Model $record): string {
                        return $record->player_id ? 'player' : 'coach';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'player' => 'warning',
                        'coach' => 'info',
                    }),
                TextColumn::make('name')
                    ->state(function (Model $record): string {
                        return $record->player_id ? $record->player?->name : $record->coach?->name;
                    })->searchable()->sortable(),

                TextColumn::make('message')->searchable(),
                IconColumn::make('is_complaint')
                    ->label('Complaint-Suggestion')
                    ->boolean()
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-badge')->searchable(),
            ])
            ->filters([
                TernaryFilter::make('is_complaint'),
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
