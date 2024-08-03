<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DoughnutChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 2;

    protected static ?string $maxHeight = '275px';

    protected static ?string $maxWidth = '275px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'My First Dataset',
                    'data' => [300, 50, 100],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                    'hoverOffset' => 4,

                ],
            ],
            'labels' => [
                'Red',
                'Blue',
                'Yellow',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
