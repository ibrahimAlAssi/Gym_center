<?php

namespace App\Filament\Resources;

use App\Domains\Entities\Models\Coach;
use App\Filament\Resources\CoachResource\Pages;
use App\Filament\Resources\CoachResource\RelationManagers\WalletRelationManager;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CoachResource extends Resource
{
    protected static ?string $model = Coach::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile')
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->required()->unique(ignoreRecord: true),
                        TextInput::make('description')->string(),
                        TextInput::make('phone')->required()->numeric()->minLength(10)->maxLength(12),
                        TextInput::make('password')->required()->password()->visibleOn('create'),
                        TextInput::make('experienceYears')->required()->integer()->minValue(1)->maxValue(30),
                        TextInput::make('specialization')->required()->string(),
                        TextInput::make('subscribePrice')->required()->numeric()->minValue(0)->maxValue(1000000),
                        SpatieMediaLibraryFileUpload::make('coaches')
                            ->collection('coaches')
                            ->rule([
                                'required',
                                'image',
                                'mimes:jpeg,png,jpg,gif,svg',
                                'max:2048', // Maximum file size in kilobytes
                            ],)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->toggleable(),
                TextColumn::make('email')->searchable()->toggleable(),
                SpatieMediaLibraryImageColumn::make('coaches')
                    ->collection('coaches')->toggleable()->label('Avatar'),
                TextColumn::make('phone')->searchable()->toggleable(),

                TextColumn::make('experienceYears')->searchable()->toggleable()->sortable(),

                TextColumn::make('specialization')->searchable()->toggleable()->sortable(),
                TextColumn::make('subscribePrice')->searchable()->toggleable()->sortable(),

                TextColumn::make('created_at')->sortable()
                    ->date('M d , Y')
                    ->label('Create')
                    ->toggleable(),

                TextColumn::make('wallet.available')->label('available')->toggleable(),
                TextColumn::make('wallet.pending')->label('pending')->toggleable(),
                TextColumn::make('wallet.total')->label('total')->toggleable(),
            ])
            ->filters([
                SelectFilter::make('experienceYears')
                    ->options(
                        fn (): array => Coach::query()->pluck('experienceYears', 'experienceYears')->all()
                    )->searchable(),
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
            WalletRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoaches::route('/'),
            'create' => Pages\CreateCoach::route('/create'),
            'edit' => Pages\EditCoach::route('/{record}/edit'),
        ];
    }
}
