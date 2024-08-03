<?php

namespace App\Filament\Resources\DietResource\RelationManagers;

use App\Domains\Club\Models\Food;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FoodsRelationManager extends RelationManager
{
    protected static string $relationship = 'foods';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('name')
                    ->options(Food::all()->pluck('name', 'id'))->required(),
                Select::make('allowed')->options([
                    '1' => 'Yes',
                    '0' => 'No',
                ])->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('allowed')
                    ->state(function (Model $record): string {
                        return $record->allowed == 1 ? 'Yes' : 'No';

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
                TernaryFilter::make('allowed'),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect()
                    ->multiple()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Select::make('allowed')->options([
                            '1' => 'Yes',
                            '0' => 'No',
                        ])->required(),
                    ]),
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
