<?php

namespace App\Filament\Resources\BukuResource\Widgets;

use App\Models\Buku;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BukuStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Buku', Buku::count())
                ->description('Total Buku')
                ->descriptionIcon('heroicon-m-book-open', IconPosition::Before)
                ->chart([1,3,5,10,20,40])
                ->color('success')
        ];
    }
}
