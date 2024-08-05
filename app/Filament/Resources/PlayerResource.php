<?php

namespace App\Filament\Resources;

use App\Domains\Entities\Models\Player;
use App\Filament\Resources\PlayerResource\Pages;
use App\Filament\Resources\PlayerResource\RelationManagers\OrderDietsRelationManager;
use App\Filament\Resources\PlayerResource\RelationManagers\WalletRelationManager;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile')
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Select::make('gender')
                            ->required()
                            ->options([
                                'male' => 'male',
                                'female' => 'female',
                            ])->required(),
                        TextInput::make('phone')
                            ->required()
                            ->numeric()
                            ->minLength(10)
                            ->maxLength(12),
                        DatePicker::make('birthday')
                            ->format('Y-m-d')
                            ->minDate('1/1/1940')
                            ->required(),
                        Select::make('coach_id')->relationship('coach', 'name')->searchable()->preload(),
                        TextInput::make('password')->required()->password()->visibleOn('create')
                            ->columnSpanFull(),
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
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
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email')
                    ->toggleable(),

                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatar')
                    ->toggleable(),

                TextColumn::make('coach.name')->label('coach')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('gender')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('birthday')
                    ->date('Y-m-d')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('created_at')->sortable()
                    ->date('M d , Y')
                    ->label('Create')
                    ->toggleable(),

                TextColumn::make('wallet.available')
                    ->label('available')
                    ->toggleable(),

                TextColumn::make('wallet.pending')
                    ->label('pending')
                    ->toggleable(),

                TextColumn::make('wallet.total')
                    ->label('total')
                    ->toggleable(),
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
            WalletRelationManager::class,
            OrderDietsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
