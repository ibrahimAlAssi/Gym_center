<?php

namespace App\Filament\Resources\OrderDietResource\Pages;

use App\Filament\Resources\OrderDietResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrderDiets extends ListRecords
{
    protected static string $resource = OrderDietResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
