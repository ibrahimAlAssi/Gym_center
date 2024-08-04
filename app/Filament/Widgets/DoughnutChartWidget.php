<?php

namespace App\Filament\Widgets;

use App\Domains\Plans\Models\Subscription;
use Filament\Widgets\ChartWidget;

class DoughnutChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Plans';

    protected static ?int $sort = 2;

    protected static ?string $maxHeight = '275px';

    protected static ?string $maxWidth = '275px';

    protected function getData(): array
    {
        $normal = Subscription::where('plan_id', 1)->where('start_date', '>', now()->subMonth())
        ->count();
        $vip = Subscription::where('plan_id', 2)->where('start_date', '>', now()->subMonth())
        ->count();
        $premium = Subscription::where('plan_id', 3)->where('start_date', '>', now()->subMonth())
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'My First Dataset',
                    'data' => [$normal, $vip, $premium],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                    'hoverOffset' => 4,

                ],
            ],
            'labels' => [
                'Normal',
                'VIP',
                'Premium',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
