<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class LineWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 2;

    // protected static ?string $maxHeight = '700px';

    // protected static ?string $maxWidth = '450px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                    // 'backgroundColor' => [
                    //     'rgba(255, 99, 132, 0.2)',
                    //     'rgba(255, 159, 64, 0.2)',
                    //     'rgba(255, 205, 86, 0.2)',
                    //     'rgba(75, 192, 192, 0.2)',
                    //     'rgba(54, 162, 235, 0.2)',
                    //     'rgba(153, 102, 255, 0.2)',
                    //     'rgba(201, 203, 207, 0.2)',
                    // ],
                    // 'borderColor' => [
                    //     'rgb(255, 99, 132)',
                    //     'rgb(255, 159, 64)',
                    //     'rgb(255, 205, 86)',
                    //     'rgb(75, 192, 192)',
                    //     'rgb(54, 162, 235)',
                    //     'rgb(153, 102, 255)',
                    //     'rgb(201, 203, 207)',
                    // ]

                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        // return 'line';
        return 'line';
    }
}
