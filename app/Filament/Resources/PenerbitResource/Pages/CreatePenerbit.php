<?php

namespace App\Filament\Resources\PenerbitResource\Pages;

use App\Filament\Resources\PenerbitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenerbit extends CreateRecord
{
    protected static string $resource = PenerbitResource::class;    
    //redirect to index after creation
    public function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index');
    }
}
