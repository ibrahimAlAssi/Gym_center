<?php

namespace App\Filament\Resources\OrderDietResource\Pages;

use App\Filament\Resources\OrderDietResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderDiet extends EditRecord
{
    protected static string $resource = OrderDietResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
