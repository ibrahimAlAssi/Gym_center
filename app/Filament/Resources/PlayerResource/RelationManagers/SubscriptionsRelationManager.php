<?php

namespace App\Filament\Resources\PlayerResource\RelationManagers;

use App\Domains\Entities\Models\Coach;
use App\Domains\Plans\Models\Discount;
use App\Domains\Plans\Models\Plan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('plan_id')
                    ->label('plan')
                    ->options(Plan::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        $discount = Discount::where('plan_id', $state)
                            ->where('start_date', '<=', now())
                            ->where('end_date', '>=', now())
                            ->first();
                        $plan = Plan::find($state);
                        $set('discount_id', $discount?->id);
                        $set('discount', $discount?->value);
                        $set('cost', number_format($plan->cost * (1 - $discount?->value / 100), 2));
                    }),
                Select::make('coach_id')
                    ->label('coach')
                    ->options(Coach::all()->pluck('name', 'id'))
                    ->searchable(),
                Hidden::make('discount_id')
                    ->nullable(),
                TextInput::make('discount')
                    ->nullable()
                    ->disabled(),

                DatePicker::make('start_date')
                    ->format('Y-m-d')
                    ->after(now()->subDay())
                    ->default(now())
                    ->readonly(),
                DatePicker::make('end_date')
                    ->format('Y-m-d')
                    ->default(now()->addMonth())
                    ->readonly(),

                TextInput::make('cost')
                    ->nullable(),
                TextInput::make('description')
                    ->nullable(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('plan_id')
            ->columns([
                TextColumn::make('plan.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('coach.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('cost')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('start_date')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('end_date')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('id', 'desc');
    }
}
