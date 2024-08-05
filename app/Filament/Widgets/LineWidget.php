<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Log;
use App\Domains\Plans\Models\Subscription;

class LineWidget extends ChartWidget
{
    protected static ?string $heading = 'Subscriptions';

    protected static ?int $sort = 2;

    // protected static ?string $maxHeight = '700px';

    // protected static ?string $maxWidth = '450px';

    protected function getData(): array
    {
        $data = Trend::model(Subscription::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        // Log::info($data);
        return [
            'datasets' => [
                [
                    'label' => 'Subscription',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            // 'labels' => $data->map(fn (TrendValue $value) => $value->date),
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M')),
        ];
    }

    protected function getType(): string
    {
        // return 'line';
        return 'line';
    }
}
