<?php

namespace App\Filament\Resources\PenerbitResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PenerbitResource;
use App\Filament\Resources\PenerbitResource\Widgets\PenerbitStats;

class ListPenerbits extends ListRecords
{
    protected static string $resource = PenerbitResource::class;

   
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
PenerbitStats::class,

       ];
    }
 
}
