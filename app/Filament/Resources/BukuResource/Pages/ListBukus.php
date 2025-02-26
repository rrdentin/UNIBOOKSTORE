<?php

namespace App\Filament\Resources\BukuResource\Pages;

use Filament\Actions;
use App\Filament\Resources\BukuResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\BukuResource\Widgets\BukuStats;

class ListBukus extends ListRecords
{
    protected static string $resource = BukuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BukuStats::class,

        ];
    }
}
