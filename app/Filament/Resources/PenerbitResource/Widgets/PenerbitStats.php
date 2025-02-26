<?php

namespace App\Filament\Resources\PenerbitResource\Widgets;

use App\Models\Penerbit;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PenerbitStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Penerbit', Penerbit::count())
                ->description('Total Penerbit')
                ->descriptionIcon('heroicon-m-building-office-2', IconPosition::Before)
                ->chart([1,3,5,10,20,40])
                ->color('info')
        ];
    }
}
