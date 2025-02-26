<?php

namespace App\Filament\Widgets;

use App\Models\Buku;
use App\Models\Penerbit;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BukuPenerbitWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $stokTerendah = Buku::min('stok');

        // Count the number of books with the lowest stock
        $totalBukuStokTerendah = Buku::where('stok', $stokTerendah)->count();
        return [
            Stat::make('Total Buku', Buku::count())
            ->description('Total Buku')
            ->descriptionIcon('heroicon-m-book-open', IconPosition::Before)
            ->chart([1,3,5,10,20,40])
            ->color('success'),
            Stat::make('Total Penerbit', Penerbit::count())
                ->description('Total Penerbit')
                ->descriptionIcon('heroicon-m-building-office-2', IconPosition::Before)
                ->chart([1,3,5,10,20,40])
                ->color('info'),
                Stat::make('Kebutuhan Buku',$totalBukuStokTerendah)
                ->description('Kebutuhan Buku')
                ->descriptionIcon('heroicon-m-exclamation-triangle', IconPosition::Before)
                ->chart([1,3,5,10,20,40])
                ->color('danger'),
        ];
    }
}
