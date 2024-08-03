<?php

namespace App\Filament\Widgets;

use App\Domains\Club\Models\OrderDiet;
use App\Domains\Entities\Models\Coach;
use App\Domains\Entities\Models\Player;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MainWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Players', Player::count())
                ->description('all players in club')
                ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
                ->chart([1, 6, 50, 80, 90])
                ->color('success'),

            Stat::make('Total Coaches', Coach::count())
                ->description('all coaches in club')
                ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
                ->chart([1, 6, 50, 80, 90])
                ->color('info'),

            Stat::make('Total New Order Diets', OrderDiet::where('status', 0)->count())
                ->description('New Order Diets That Not Managing Yet')
                ->descriptionIcon('heroicon-o-building-library', IconPosition::Before)
                ->chart([1, 6, 50, 80, 90])
                ->color('danger'),
        ];
    }
}
